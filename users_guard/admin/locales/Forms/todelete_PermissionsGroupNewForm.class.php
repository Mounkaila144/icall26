<?php

class mfValidatorPermissionGroupExists extends mfValidatorBase {
    
    function __construct($options = array(), $messages = array(),$site=null) {
        $this->site=$site;     
        parent::__construct($options, $messages);
    }
    
    function configure($options = array(), $messages = array()) {
       
        parent::configure($options,$messages);      
        $this->addMessage('exist', __('[{value}] already exists.'));
    }
    
    function doIsValid($value) {
        if (!isset($value['name']))
            return $value;
        if ($value['name']=="")
            return $value;       
        $permission=new PermissionGroup($value,$this->site);
        if ($permission->isExist())
        {
            throw new mfValidatorErrorSchema($this, array(
                    'name' => new mfValidatorError($this, 'exist',array('value'=>$value['name'])),
            ));
        }    
        return $value;
    }
}

class PermissionGroupNewForm extends mfFormSite {

    function __construct($defaults = array(),$options=array(),$site=null) {               
        parent::__construct($defaults, $options,$site);
    } 
    
    function configure() { 
         $this->setValidators(array(
            'name' => new mfValidatorName(), // @TODO define min max + messages           
        ));
        $this->validatorSchema->setPostValidator(new mfValidatorPermissionGroupExists($this->getDefaults(),array(),$this->site));
    }
}

class PermissionsGroupNewForm extends mfFormSite {

   function __construct($defaults = array(),  $site = null) {
       parent::__construct($defaults, array(), $site);
   }
    
    function configure() { 
      
        $this->setDefault('count', $this->getDefault('count',2)); // Number of form fields by default     
        $this->setValidators(array(
            'count'=>new mfValidatorInteger(array('min'=>1,"max"=>10)),   // min/max form fields        
        ));
        $this->embedFormForEach('collection',new PermissionGroupNewForm(array(),array(),$this->site),$this->getDefault('count')); 
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'checkGroupNames'))));
    }
    
    function checkGroupNames($validator,$values)
    {
        $checkin=array();
        $error=false;
        // Check item in double 
        foreach ($values['collection'] as $index=>$form)
        {
            foreach ($form as $key=>$value)
            {
              try
              {  
                  if (in_array($key,array('name')) && $value!="")
                  {        
                      if ($checkin[(string)$value]==true)
                            throw new mfValidatorError($this['collection'][$index]['name']->getValidator(),__('This [{value}] already exists in this form.'),array('key'=>$key,'value'=>$value));
                      $checkin[(string)$value]=true;

                   }
               }
               catch (mfValidatorError $e)
               {
                       $this['collection'][$index][$key]->setError($e);
                       $error=true;
               }
            }    
        }  
        if ($error)
           throw new mfValidatorErrorSchema($validator,array("collection"=>new mfValidatorError($validator,"error")));  // Dummy Exception with no error
        return $values;
    }
}