<?php

class PermissionSuperAdminNewForm extends mfForm {

    function configure() { 
         $this->setValidators(array(
            'name' => new mfValidatorName(), // @TODO define min max + messages           
        ));
        $this->validatorSchema->setPostValidator(new mfValidatorPermissionSuperAdminExists());
    }
}

class PermissionsSuperAdminNewForm extends mfForm {

    function configure() { 
        $this->setDefault('permissions_count', $this->getDefault('permissions_count',2)); // Number of form fields by default 
        $this->embedFormForEach('permissions',new permissionSuperAdminNewForm(),$this->getDefault('permissions_count')); 
        $this->setValidator('permissions_count', new mfValidatorInteger(array('min'=>1,"max"=>10)));   // min/max form fields
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'checkPermissionNames'))));
    }
    
    function checkPermissionNames($validator,$values)
    {
        $checkin=array();
        $error=false;        
        foreach ($values['permissions'] as $count=>$form)
        {
            foreach ($form as $key=>$value)
            {
              try
              {  
                  if (in_array($key,array('name'))&&$value!="")
                  {        

                        if (isset($checkin[$value]))
                        {
                            $checkin[$value]=true; 
                            throw new mfValidatorError($this['permissions'][$count]['name']->getValidator(),__('this {key} [{value}] already exists.'),array('key'=>$key,'value'=>$value));
                        }    
                        else
                           $checkin[$value]=false; 
                   }

               }
               catch (mfValidatorError $e)
               {
                       $this['permissions'][$count][$key]->setError($e);
                       $error=true;
               }
            }    
        }  
        if ($error)
           throw new mfValidatorErrorSchema($validator,array("permissions"=>new mfValidatorError($validator,"error")));  // Dummy Exception with no error      
        return $values;
    }
    
}