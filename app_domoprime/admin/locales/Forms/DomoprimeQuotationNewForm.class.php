<?php

class DomoprimeQuotationItemForm  extends mfForm {
    
    function configure() {
       // var_dump(count($this->getDefault('items')));
        $this->setValidators(array(
            'product_id'=>new mfValidatorInteger(),
            'quantity'=>new mfValidatorI18nNumber(),
            'items'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('items'))),
        ));
    }
}

class DomoprimeQuotationNewForm extends mfForm {
         
    protected $meeting=null,$settings=null;
    
   function __construct(CustomerMeeting $meeting,$defaults = array()) {
       $this->meeting=$meeting;
       $this->settings=DomoprimeSettings::load($this->site);
       $this->forms=new CustomerMeetingForms($this->meeting) ;
       parent::__construct($defaults);
   }
    
   function getSettings()
    {
        return $this->settings;
    }
    
     function getForms()
    {
        return $this->forms;
    }
    
    
    function getSurfaces()
    {
        if ($this->surfaces)
            return $this->surfaces;
        $this->surfaces=new mfArray();
         foreach ($this->getSettings()->getSurfaceForFieldByProducts() as $product_id=>$surface)
         {          
             $surface=$this->getForms()->getDataFromFieldname($surface->getForm()->get('name'),$surface->get('name'));
             if ($surface > 0)
                $this->surfaces[$product_id]=$surface;
         }                  
         return $this->surfaces;
    }
    
     function getSurfaceFromProduct($product,$default)
    {
        return isset($this->surfaces[$product->get('id')])?$this->surfaces[$product->get('id')]:$default;
    }
    
    function configure()
    {                       
       ProductItem::loadProductsAndItemsForMeeting($this->getMeeting(),$this->getSurfaces()->getKeys());        
       $this->products=$this->getMeeting()->getActiveProductsWithTax();
       if (!$this->getDefaults())
       {
           $defaults=array();
           foreach ($this->products as $product)           
               $defaults[]=array('quantity'=>$this->getSurfaceFromProduct($product, 0.0));           
           $this->setDefault('products',$defaults);
       }    
       $this->createEmbedFormForEach('products', 'DomoprimeQuotationItemForm', count($this->getDefault('products')));
    }
    
    function isChecked($product,$item)
    {              
        foreach ($this->getDefault('products') as $p)
        {
            if (!isset($p['items']))
                continue;                
            foreach ($p['items'] as $i)
            {                              
                if ($product->get('id')==$p['product_id'] && $item->get('id') == $i)
                {                    
                    return true;
                }    
            }    
        }    
        return false;
    }        
    
    function getMeeting()
    {
        return $this->meeting;
    }
    
    function getProducts()
    {
        return $this->products;
    }
}

