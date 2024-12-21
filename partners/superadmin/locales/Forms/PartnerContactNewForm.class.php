<?php


class PartnerContactNewForm extends PartnerContactBaseForm {
    
   
     function configure() {              
        parent::configure();
        unset($this['id']);        
     }
    
}


