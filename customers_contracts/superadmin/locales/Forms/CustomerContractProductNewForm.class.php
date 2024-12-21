<?php



 class CustomerContractProductNewForm extends CustomerContractProductBaseForm {
    
    
   
    
    function configure()
    {                        
        parent::configure();
        unset($this['id']);
    }
    
 
}


