<?php

class CustomerMeetingMutualProductEngine  {
    
    protected $mutual_product=null;
    protected $engine_core=null;
    protected $commission_total=0.0;
    protected $decommission_total=0.0;
    
    function __construct(AppMutualEngineCore $engine, CustomerMeetingMutualProductForEngine $product) {
        $this->engine_core = $engine;
        $this->mutual_product = $product;
    }
    
    function getMutualProduct()
    {
        return $this->mutual_product;
    }
    
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
        //calculer tt les commissions
        $this->commission_total = ($this->mutual_product->hasCommissions()?$this->mutual_product->getCommissions()->process($this->engine_core->getMeetingDurationInMounths(), $this->mutual_product):0.0);//nb_mois du contrat ou meeting
        
        //calculer tt les decommissions
        $this->decommission_total = ($this->mutual_product->hasDecommissions()?$this->mutual_product->getDecommissions()->process($this->engine_core->getMeetingDurationInMounths(), $this->mutual_product):0.0);//nb_mois du contrat ou meeting           
        
    }
    
    function getEngineCore()
    {
        return $this->engine_core;
    }
}
