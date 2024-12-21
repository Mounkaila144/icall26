<?php

class MutualPartnerForEngine extends MutualPartnerBase {
    
    protected $engine=null;
    protected $products_for_engine=null;
    protected $selected_products_for_engine=null;
    
    function getProductByKey($key)
    {
        return $this->products_for_engine[$key];
    }
    
    function loadEngine(AppMutualEngineCore $engine)
    {
        $this->engine = new MutualPartnerEngine($engine, $this);
    }
    
    function getEngine()
    {
        return $this->engine;
    }
        
    function addProductForEngine(MutualProductForEngine $product)
    {
        if($this->products_for_engine===null)
            $this->products_for_engine = new MutualProductCollectionForEngine();
        if(!isset($this->products_for_engine[$product->get('id')]))
            $this->products_for_engine[$product->get('id')] = $product;
        return $this->products_for_engine;
    }
    
    function getProductsForEngine()
    {
        return $this->products_for_engine;
    }
    
    function addSelectedProductForEngine(CustomerMeetingMutualProductForEngine $product)
    {
        if($this->selected_products_for_engine===null)
            $this->selected_products_for_engine = new CustomerMeetingMutualProductCollectionForEngine(null,$this->getSite());
        if(!isset($this->selected_products_for_engine[$product->get('id')]))
            $this->selected_products_for_engine[$product->get('id')] = $product;
        return $this->selected_products_for_engine;
    }
    
    function getSelectedgetProductsForEngine()
    {
        return $this->selected_products_for_engine;
    }
}
