<?php



 class PermissionsGroupI18nForm extends PermissionsGroupI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('group_id', new mfValidatorInteger());
    }
    
 
}


