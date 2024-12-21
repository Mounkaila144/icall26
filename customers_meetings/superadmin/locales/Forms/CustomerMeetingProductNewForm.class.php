<?php



 class CustomerMeetingProductNewForm extends CustomerMeetingProductBaseForm {
    
    
   
    
    function configure()
    {                        
        parent::configure();
        unset($this['id']);
    }
    
 
}


