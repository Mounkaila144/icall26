<?php


class MutualPartnerViewForm extends PartnerBaseForm {
    
    
    function configure() {
        parent::configure();
        unset($this['country']);
    }
    
    
    
}


