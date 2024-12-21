<?php

require_once dirname(__FILE__)."/SiteForm.class.php";

class SiteEditForm extends SiteForm {

    function configure() {       
        parent::configure();
        $this->setValidator('site_id',new mfValidatorInteger());
        unset($this['site_host']); // No need >remove
        unset($this['site_db_name']); // No need >remove
        
    }
}