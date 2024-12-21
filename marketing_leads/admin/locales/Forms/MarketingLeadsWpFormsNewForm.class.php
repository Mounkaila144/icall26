<?php


class MarketingLeadsWpFormsNewForm extends MarketingLeadsWpFormsBaseForm {
    
    function configure()
    {
        parent::configure();
        unset($this['id']);
    }
    
}

