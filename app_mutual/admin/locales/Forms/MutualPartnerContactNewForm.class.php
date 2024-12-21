<?php


class MutualPartnerContactNewForm extends PartnerContactBaseForm {
    
   
    function configure() {              
        parent::configure();
        unset($this['id']);        
    }
    
}


