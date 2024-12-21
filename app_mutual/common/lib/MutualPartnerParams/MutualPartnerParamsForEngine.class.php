<?php

class MutualPartnerParamsForEngine extends MutualPartnerParamsBase {
    
    protected $engine=null;
    
    function loadEngine(AppMutualEngineCore $engine)
    {
        $this->engine = new MutualPartnerParamsEngine($engine, $this);
    }
    
    function getEngine()
    {
        return $this->engine;
    }
    
}
