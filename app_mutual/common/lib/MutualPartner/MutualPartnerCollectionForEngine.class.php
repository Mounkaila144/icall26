<?php

class MutualPartnerCollectionForEngine extends MutualPartnerCollection {
    
    protected $commission_total = 0.0;
    protected $decommission_total = 0.0;
    protected $engine_core=null;
            
    function getTotalCommission()
    {
        return $this->commission_total;
    }
    
    function getTotalDecommission()
    {
        return $this->decommission_total;
    }
    
    function process()
    {
        foreach ($this->collection as $mutual)
        {
            $mutual->loadEngine($this->engine_core);
            $mutual->getEngine()->process();
            $this->commission_total += $mutual->getEngine()->getTotalCommission();
            $this->decommission_total += $mutual->getEngine()->getTotalDecommission();
        }
        
    }
   
    function getProductsIds()
    {
        $products = new mfArray();
        
        foreach($this->collection as $mutual){
            foreach($mutual->getProductsForEngine() as $product)
            {
                $products[$product->get('id')] = $product;
            }
        }
        return $products;
    }
        
    function setEngine(AppMutualEngineCore $engine)
    {
        $this->engine_core = $engine;
        return $this;
    }
}
