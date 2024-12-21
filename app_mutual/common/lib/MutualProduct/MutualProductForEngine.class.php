<?php

class MutualProductForEngine extends MutualProductBase {
    
    protected $engine=null;
    
    function getCommissions()
    {
        return $this->commissions;
    }
    
    function addCommission(MutualProductCommissionForEngine $commission)
    {
        if($this->commissions===null)
            $this->commissions = new MutualProductCommissionCollectionForEngine();
        if(!isset($this->commissions[$commission->get('id')]))
            $this->commissions[$commission->get('id')] = $commission;
        return $this;
    }
    
    function getDecommissions()
    {
        return $this->decommissions;
    }
    
    function addDecommission(MutualProductDecommissionForEngine $decommission)
    {
        if($this->decommissions===null)
            $this->decommissions = new MutualProductDecommissionCollectionForEngine();
        if(!isset($this->decommissions[$decommission->get('id')]))
            $this->decommissions[$decommission->get('id')] = $decommission;
        return $this;
    }
    
    function loadEngine(AppMutualEngineCore $engine)
    {
        $this->engine = new MutualProductEngine($engine, $this);
    }
    
    function getEngine()
    {
        return $this->engine;
    }
    
    
    function hasCommissions()
    {
        return ($this->commissions!==null);
    }
    
    function hasDecommissions()
    {
        return ($this->decommissions!==null);
    }
}
