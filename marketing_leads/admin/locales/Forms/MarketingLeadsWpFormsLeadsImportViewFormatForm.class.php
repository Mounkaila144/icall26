<?php

require_once dirname(__FILE__)."/MarketingLeadsWpFormsLeadsImportFormatForm.class.php";

class MarketingLeadsWpFormsLeadsImportViewFormatForm extends MarketingLeadsWpFormsLeadsImportFormatForm {

    function configure() { 
        parent::configure();
        $this->setValidator('id', new mfValidatorInteger());
        unset($this['name']);
    }     
    
}