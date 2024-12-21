<?php


class MarketingLeadsWpLandingPageSiteNewForm extends MarketingLeadsWpLandingPageSiteBaseForm {
    
    function configure()
    {
        parent::configure();
        unset($this['id']);
    }
    
}

