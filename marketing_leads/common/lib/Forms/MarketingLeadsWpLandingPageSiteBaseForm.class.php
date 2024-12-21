<?php


class MarketingLeadsWpLandingPageSiteBaseForm extends mfForm {
    
    function configure()
    {
        //'host_site','host_db','name_db','password_db'
        $this->setValidators(array(
            'id'=> new mfValidatorInteger(),
            'host_site' => new mfValidatorString(),
            'host_db' => new mfValidatorString(),
            'name_db' => new mfValidatorName(),
            'user_db' => new mfValidatorString(),
            'password_db' => new mfValidatorString(array("required"=>false)),
            'campaign' => new mfValidatorString(),
            'cron_time'=> new mfValidatorInteger(),
        ));
    }
}

