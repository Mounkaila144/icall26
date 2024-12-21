<?php

class MutualProductCommissionForEngine extends MutualProductCommissionBase {

    function loadEngine(AppMutualEngineCore $engine)
    {
        $this->engine = new MutualProductCommissionEngine($engine, $this);
    }
    
    function getEngine()
    {
        return $this->engine;
    }
    
    function isInDuration($duration)
    {
        return ($this->get('from') <= $duration && $duration <= $this->get('to'));
    }
}
