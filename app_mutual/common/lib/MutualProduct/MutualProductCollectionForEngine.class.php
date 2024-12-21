<?php

class MutualProductCollectionForEngine extends MutualProductCollection {
    
    protected $commission_total = 0.0;
    protected $decommission_total = 0.0;
    protected $engine_core = null;
    
    
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
        foreach ($this->collection as $product)
        {
            $product->loadEngine($this->engine_core);
            $product->getEngine()->process();
            $this->commission_total += $product->getEngine()->getTotalCommission();
            $this->decommission_total += $product->getEngine()->getTotalDecommission();
        }
    }
    
    function setEngine(AppMutualEngineCore $engine)
    {
        $this->engine_core = $engine;
        return $this;
    }
}
