<?php


class PartnerLayerContactNewForm extends PartnerLayerContactBaseForm {
    
   
     function configure() {              
        parent::configure();
        unset($this['id']);        
     }
    
}


