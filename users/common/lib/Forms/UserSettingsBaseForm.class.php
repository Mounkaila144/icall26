<?php



 class UserSettingsBaseForm extends mfFormSite {
 
     protected $user=null;
     
   function __construct($user,$defaults=array(),$site=null)
    {
       $this->user=$user;
        parent::__construct($defaults,array(),$site);
    } 
  
    function getUser()
    {
        return $this->user;
    }
    
    function configure()
    {
        $this->setValidators(array(                       
            "has_manager2"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "has_callcenter"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "activity_timer"=>new mfValidatorInteger(array('min'=>10,'max'=>60 * 60)),
            "remaining_time"=>new mfValidatorInteger(array('min'=>60,'max'=>360)),
                       
            ));                      
    }
    
 
}


