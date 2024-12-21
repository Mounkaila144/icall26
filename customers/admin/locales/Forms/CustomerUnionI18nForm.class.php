<?php



 class CustomerUnionI18nForm extends CustomerUnionI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('union_id', new mfValidatorInteger());
    }
    
 
}


