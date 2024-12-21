<?php

class  MutualProductDecommissionEngine  {
    
    protected $mutual_decommission=null;
    protected $engine_core=null;
    
    function __construct(AppMutualEngineCore $engine, MutualProductDecommissionForEngine $decommission) {
        $this->engine_core = $engine;
        $this->mutual_decommission = $decommission;
    }
    
    function getEngineCore()
    {
        return $this->engine_core;
    }
}
