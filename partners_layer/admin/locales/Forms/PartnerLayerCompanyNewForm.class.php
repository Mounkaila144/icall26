<?php

class PartnerLayerCompanyNewFom extends PartnerLayerCompanyBaseForm {
    
    
    
    function configure() {
        parent::configure();
        unset($this['id']);
    }
    
}
