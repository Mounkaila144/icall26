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

class DomoprimeQuotationNewForContractForm extends mfForm {
         
    protected $contract=null,$settings=null,$products=null,$user=null;
    
   function __construct($user,CustomerContract $contract,$defaults = array()) {
       $this->contract=$contract;
       $this->user=$user;     
     //  $this->meeting=$this->getContract()->getMeeting();
       $this->settings=DomoprimeSettings::load();
       $this->form_request=new DomoprimeCustomerRequest($contract) ;
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
    
    function getUser()
    {
        return $this->user;
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
     /*  if ($this->getContract()->hasMeeting())
       {                         
            ProductItem::loadProductsAndItemsForMeeting($this->getMeeting(),$this->getSurfaces()->getKeys());  
           $this->products=$this->getMeeting()->getActiveProductsWithTax();
       }     
       else
       {    */          
        ProductItem::loadProductsAndItemsForContract($this->getContract(),$this->getSurfaces()->getKeys());          
        $this->products=$this->getContract()->getActiveProductsWithTax();
        //    echo "<pre>"; var_dump($this->quotation_products); echo "</pre>"; 
     //  }      
       //  echo "<pre>"; var_dump($this->products); 
       if (!$this->getDefaults())
       {
           $defaults=array();
           foreach ($this->products as $product)           
               $defaults[]=array('quantity'=>$this->getSurfaceFromProduct($product, 0.0));           
           $this->setDefault('products',$defaults);          
           $this->setDefault('dated_at',$this->getSettings()->getDatedAtByDefault());
       }    
       $this->createEmbedFormForEach('products', 'DomoprimeQuotationItemForm', count($this->getDefault('products')));
       $this->setValidator('dated_at',new mfValidatorI18nDate(array("date_format"=>"a")));
       if ($this->getUser()->hasCredential(array(array('superadmin','app_domoprime_quotation_new_header'))))
          $this->setValidator('header',new mfValidatorString(array("required"=>false)));
       if ($this->getUser()->hasCredential(array(array('superadmin','app_domoprime_quotation_new_remarks'))))
          $this->setValidator('remarks',new mfValidatorString(array("required"=>false)));
       if ($this->getUser()->hasCredential(array(array('superadmin','app_domoprime_quotation_new_footer'))))
          $this->setValidator('footer',new mfValidatorString(array("required"=>false)));
       if ($this->getUser()->hasCredential(array(array('superadmin','app_domoprime_quotation_new_fixed_prime'))))
          $this->setValidator('fixed_prime',new mfValidatorI18nNumber(array('min'=>0)));
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
    
    
    function getContract()
    {
        return $this->contract;
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

