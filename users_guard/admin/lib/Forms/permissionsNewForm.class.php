<?php

class mfValidatorPermissionExists extends mfValidatorBase {
       
    
    function configure($options = array(), $messages = array()) {       
        parent::configure($options,$messages);  
        $this->addMessage('exist', __('[{value}] already exists.'));
    }
    
    function doIsValid($value) {
        if (!isset($value['name']))
            return $value;
        if ($value['name']=="")
            return $value;      
        $permission=new Permission($value,'admin');
        if ($permission->isExist())
        {
            throw new mfValidatorErrorSchema($this, array(
                    'name' => new mfValidatorError($this, 'exist',array('value'=>$value['name'])),
            ));
        }    
        return $value;
    }
}

class permissionNewForm extends mfForm {   
    
    static $groups=array();
    
      
    function configure() { 
         if (!self::$groups)
             self::$groups=array(""=>"")+PermissionGroupUtils::getPermissionsGroupsForSelect($this->getSite());
         $this->setValidators(array(
            'name' => new mfValidatorName(), // @TODO define min max + messages  
            'group_id'=>new mfValidatorChoice(array("required"=>false,"key"=>true,"choices"=>self::$groups))
        ));
        $this->validatorSchema->setPostValidator(new mfValidatorPermissionExists($this->getDefaults()));
    }
}

class permissionsNewForm extends mfForm {
   
    
    function configure() { 
      
        $this->setDefault('count', $this->getDefault('count',2)); // Number of form fields by default     
        $this->setValidators(array(
            'count'=>new mfValidatorInteger(array('min'=>1,"max"=>10)),   // min/max form fields          
        ));
        $this->embedFormForEach('collection',new permissionNewForm(),$this->getDefault('count')); 
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'checkPermissionNames'))));
    }
    
    function checkPermissionNames($validator,$values)
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
                            throw new mfValidatorError($this['collection'][$index]['name']->getValidator(),__('this {key} [{value}] already exists in this form.'),array('key'=>$key,'value'=>$value));
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