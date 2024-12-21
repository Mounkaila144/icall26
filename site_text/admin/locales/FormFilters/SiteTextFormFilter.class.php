<?php


class SiteTextFormFilter extends mfFormFilterBase {

    protected $user=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getuser()
    {
        return $this->user;
    }
    
    function configure()
    {       
       $this->setDefaults(array(          
                      'order'=>array("key"=>"asc"),
                      'nbitemsbypage'=>"100",
       ));    
       $this->setClass('SiteText');
       // Base Query  
       $this->setFields(array());
       // Optional Objects   
       $this->setQuery("SELECT {fields} FROM ".SiteText::getTable().     
                       ($this->getUser()->hasCredential([['superadmin']])?" ":" GROUP BY ".SiteText::getTableField('key')).
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                            "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                        
                            "key"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),           
                            "module"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                            "id"=>new mfValidatorString(array("required"=>false)), 
                            "module"=>new mfValidatorString(array("required"=>false)),  
                            "key"=>new mfValidatorString(array("required"=>false)),  
                            "value"=>new mfValidatorString(array("required"=>false)),                                                                                                                                          
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                                                      
                            ),array("required"=>false)),                             
                            
            'equal' => new mfValidatorSchema(array(                               
                           "module"=>new mfValidatorChoice(array("choices"=>SiteText::getModulesForSelect()->unshift(array(''=>'')),"required"=>false,"key"=>true)),
                            ),array("required"=>false)),                                      
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"required"=>false,"key"=>true)),                    
        ));          
    }
}

