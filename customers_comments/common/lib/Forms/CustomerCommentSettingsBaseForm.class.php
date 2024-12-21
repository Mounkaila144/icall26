<?php



 class CustomerCommentSettingsBaseForm extends mfFormSite {
 
     protected $user=null;
    function __construct($user,$site=null) {       
        $this->user=$user;
        parent::__construct(array(),array(),$site);
    }
    
    function getUser()
    {
        return $this->user;
    }
  
    function configure()
    {
        $this->setValidators(array(            
            "dictionary"=>new mfValidatorMultipleString(array('required'=>false,'trim'=>true)),  
            "replacement"=>new mfValidatorString(array()),  
            ) 
        );        
    }
    
    
}


