<?php

class MarketingLeadsWpFormsStatusI18nForm extends MarketingLeadsWpFormsStatusI18nBaseForm {
    
    function configure()
    {
        parent::configure();
        $this->setValidator('status_id', new mfValidatorInteger());
    }
}


