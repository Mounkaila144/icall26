<?php

class MutualProductCommissionEngine {
    
    protected $mutual_commission=null;
    protected $engine_core=null;
    
    function __construct(AppMutualEngineCore $engine, MutualProductCommissionForEngine $commission) {
        $this->engine_core = $engine;
        $this->mutual_commission = $commission;
    }
    
    function getEngineCore()
    {
        return $this->engine_core;
    }    
}
