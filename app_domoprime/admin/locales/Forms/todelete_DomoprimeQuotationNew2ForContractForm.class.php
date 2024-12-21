<?php

class DomoprimeQuotationItem2Form  extends mfForm {
    
    function configure() {
       // var_dump(count($this->getDefault('items')));
        $this->setValidators(array(
            'item_id'=>new mfValidatorInteger(),
            'quantity'=>new mfValidatorI18nNumber(),                    
        ));
    }
}

class DomoprimeQuotationNew2ForContractForm extends mfForm {
         
    protected $contract=null,$settings=null,$products=null,$user=null;
    
   function __construct($user,CustomerContract $contract,$defaults = array()) {
       $this->contract=$contract;
       $this->user=$user;      
       $this->settings=new DomoprimeSettings(null,$this->getSite());     
       parent::__construct($defaults);
   }
    
   function getSite()
   {
       return $this->getContract()->getSite();
   }
   
   function getSettings()
    {
        return $this->settings;
    }       
    
    function getUser()
    {
        return $this->user;
    }
    
        
    function configure()
    {         
        if (!$this->hasDefaults())
        {
            $items=array();
            foreach ($this->getProducts()->getItems() as $item)             
                $items[]=array('quantity'=>1,'item_id'=>$item->get('id'));
            $this->setDefault('items', $items);
        }    
       $this->createEmbedFormForEach('items', 'DomoprimeQuotationItem2Form', count($this->getDefault('items')));       
    }                  
    
    function getContract()
    {
        return $this->contract;
    }
    
    function getProducts()
    {
        return $this->products=$this->products===null?ProductUtils::getProductsAndItemsByPosition():$this->products;
    }
   
    
    function getQuantityByItem(ProductItem $product_item)
    {
        foreach ($this->getDefault('items') as $item)
        {
            if ($item['item_id'] == $product_item->get('id'))
                return $item['quantity'];
        }    
        return 0;
    }
    
    function hasQuantityByItem(ProductItem $product_item)
    {
        if (!$this->isReady())
            return false;
        foreach ($this->getDefault('items') as $item)
        {
            if ($item['item_id'] == $product_item->get('id'))
                return true;
        }    
        return false;
    }
    
  
}

