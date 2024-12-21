<?php

class  MutualProductDecommissionForEngine  extends MutualProductDecommission {
    
    function loadEngine(AppMutualEngineCore $engine)
    {
        $this->engine = new MutualProductDecommissionEngine($engine, $this);
    }
    
    function getEngine()
    {
        return $this->engine;
    }
    
}
