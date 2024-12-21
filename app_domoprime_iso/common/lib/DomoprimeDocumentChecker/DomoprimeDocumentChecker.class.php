<?php


class DomoprimeDocumentChecker {
     
    protected $contract=null,$errors=null;
        
    function __construct(CustomerContract $contract) {
        $this->contract=$contract;      
        $this->errors=new mfArray();
    }
          
    function getContract()
    {
        return $this->contract;
    }
    
    function getSite()
    {
        return $this->getContract()->getSite();
    }
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new DomoprimeIsoSettings(null,$this->getSite()):$this->settings;
    }
    
    function getErrors()
    {
        return $this->errors;
    }
    
    function process()
    {
        $request=new DomoprimeCustomerRequest($this->getContract());        
        foreach ($this->getSettings()->getProductsBySurfaces()  as $name=>$product_id)
        {          
            if (!intval($request->get($name)))
                continue;
            if (!$this->getContract()->getProductItemsWithProductAndItem()->getProductsWithItem()->hasItemByKey($product_id))
                $this->errors[]=__("Product doesn't exist for %s",__($name));
            if (!$this->getContract()->getProductItemsWithProductAndItem()->getProductsWithItem()->getItemByKey($product_id)->hasItem())
                $this->errors[]=__("Product item doesn't exist for %s",__($name));        
            if (!$this->getContract()->getProductItemsWithProductAndItem()->getProductsWithItem()->getItemByKey($product_id)->getItem())
                $this->errors[]=__("Product item doesn't exist for %s",__($name));        
        }    
        if (!$this->errors->isEmpty())
            throw new mfException($this->getErrors()->implode());
        return $this;
    }
}
