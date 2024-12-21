<?php



 class UserProfileI18nForm extends UserProfileI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('profile_id', new mfValidatorInteger());
    }
    
 
}


