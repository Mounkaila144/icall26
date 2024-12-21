<?php

class MutualPartnerEngine {
    
    protected $mutual_partner=null;
    protected $engine_core=null;
    protected $commission_total=0.0;
    protected $decommission_total=0.0;
    
    function __construct(AppMutualEngineCore $engine, MutualPartnerForEngine $mutual) {
        $this->engine_core = $engine;
        $this->mutual_partner = $mutual;
    }
    
    function getTotalCommission()
    {
        //totale commissions pour tt les produits dans la mutuelle
        return $this->commission_total;
    }
    
    function getTotalDecommission()
    {
        //totale commissions pour tt les produits dans la mutuelle
        return $this->decommission_total;
    }
    
    function process()
    {
        $this->mutual_partner->getSelectedgetProductsForEngine()->setEngine($this->engine_core);
        $this->mutual_partner->getSelectedgetProductsForEngine()->process();
        $this->commission_total = $this->mutual_partner->getSelectedgetProductsForEngine()->getTotalCommission();
        $this->decommission_total = $this->mutual_partner->getSelectedgetProductsForEngine()->getTotalDecommission();
    }
    
    function getEngineCore()
    {
        return $this->engine_core;
    }
}
