<?php


class CallcenterNewForm extends CallcenterBaseForm {
    
   
     function configure() {              
        parent::configure();
        unset($this['id']);        
     }
    
}


