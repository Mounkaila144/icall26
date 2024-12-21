<?php


class CustomerSectorNewForm extends CustomerSectorBaseForm {
    
   
     function configure() {              
        parent::configure();
        unset($this['id']);        
     }
    
}


