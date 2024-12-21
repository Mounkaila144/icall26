<?php



 class UserSettingsForm extends UserSettingsBaseForm {
 
   
  
     function configure()
     {
         parent::configure();
         $this->setValidator('logout_timer',new mfValidatorInteger(array('min'=>5,'max'=>60)));
         $this->setValidator("has_callcenter",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));                       
     }
    
 
}


