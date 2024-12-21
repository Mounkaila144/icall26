<?php

class MarketingLeadsRecoveryEngine  {
     
    protected $sites = null;
    
    function __construct($site=null) {
        $this->sites = MarketingLeadsWpLandingPageSite::getSitesForEngine($site);
    }
    
    function process()
    {
        $this->sites->process();
    }
}
