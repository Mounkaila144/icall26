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

class DomoprimeQuotationViewForMeetingForm extends mfForm {
         
    protected $quotation=null,$user=null;
    
   function __construct(DomoprimeQuotation $quotation,$user,$defaults = array()) {
       $this->quotation=$quotation;
       $this->user=$user;
       $this->meeting=$quotation->getMeeting();     
       $this->settings=DomoprimeSettings::load($this->site);
       $this->form_request=new DomoprimeCustomerRequest($this->meeting) ;
       parent::__construct($defaults);       
   }
    
  function getSettings()
    {
        return $this->settings;
    }
    
     function getFormRequest()
    {
        return $this->form_request;
    }
    
    
     function getSurfaces()
    {
        if ($this->surfaces)
            return $this->surfaces;
        $this->surfaces=new mfArray();
         foreach ($this->getSettings()->getSurfaceNamingsForProducts() as $product_id=>$surface)
         {          
             $surface=$this->getFormRequest()->get($surface);
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
           {            
               if ($this->quotation->getProductsWithItems()->getByProducts()->getItemByKey($product->get('id')))
               {    
                   $items=array();
                   foreach ($this->quotation->getProductsWithItems()->getByProducts()->getItemByKey($product->get('id'))->getItems() as $item)
                      $items[]=$item->get('item_id');                                    
                   $defaults[]=array('product_id'=>$product->get('id'),
                                     'quantity'=>$this->quotation->getProductsWithItems()->getByProducts()->getItemByKey($product->get('id'))->get('quantity'),
                                     'items'=>$items
                                    );                     
               }
               else
               {    
               $defaults[]=array('quantity'=>$this->getSurfaceFromProduct($product, 0.0));           
               }
           }    
           $this->setDefault('products',$defaults);
       }    
       $this->createEmbedFormForEach('products', 'DomoprimeQuotationItemForm', count($this->getDefault('products')));
       $this->setValidator('dated_at',new mfValidatorI18nDate(array("date_format"=>"a")));
       $this->setValidator('id',new mfValidatorInteger());
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
    
    function getQuotation()
    {
        return $this->quotation;
    }
        
}
