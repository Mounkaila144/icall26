<?php

class UsersImportForm extends mfFormSite {
    
    protected $path=null;
    
    function __construct($path,$site = null) {
        $this->path=$path;
        parent::__construct(array(),array(), $site);
    }
    
    function getPathSourceForFiles()
    {
       return $this->path."/users";
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);       
        $this->setValidators(array(
            "username"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),
            "lastname"=>new mfValidatorString(array("max_length"=>"255")),
            "firstname"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),
            "phone"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),
            "mobile"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),           
            "email"=>new mfValidatorEmail(array("max_length"=>"255","required"=>false)),
            "is_active"=>new mfValidatorI18NBoolean(array("false"=>"NO","true"=>"YES","required"=>false)),     
            // groups
            "groups"=>new mfValidatorVariablesForImport(array("required"=>false,"separator"=>"|","remove_space"=>true)),
            // team
            "teams"=>new mfValidatorVariablesForImport(array("required"=>false,"separator"=>"|","remove_space"=>true)),
            // Function
            "functions"=>new mfValidatorVariablesForImport(array("required"=>false,"separator"=>"|","remove_space"=>true)),
            // Permissions
            "permissions"=>new mfValidatorVariablesForImport(array("required"=>false,"separator"=>"|","remove_space"=>true)),
        ));  
        $this->validatorSchema->setOption('keep_fields_unused',true);
    }      
    
    function getUser()
    {                          
        $item= new User(array('lastname'=>(string)$this['lastname'],'firstname'=>(string)$this['firstname'],'username'=>(string)$this['username']),'admin',$this->getSite());                           
        $item->add($this->getValues());       
        if (!(string)$this['username'])
            $item->set('username',strtolower((string)$this['firstname'][0].(string)$this['lastname']));
        return $item;
    }
    
    
}
