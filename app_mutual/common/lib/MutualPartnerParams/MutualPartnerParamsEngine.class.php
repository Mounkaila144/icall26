<?php

class MutualPartnerParamsEngine {
    
    protected $mutual_partner_params=null;
    protected $engine_core=null;
    
    function __construct(AppMutualEngineCore $engine, MutualPartnerParamsForEngine $mutual_params) {
        $this->engine_core = $engine;
        $this->mutual_partner_params = $mutual_params;
    }
    
    function getEngineCore()
    {
        return $this->engine_core;
    }
    
}
