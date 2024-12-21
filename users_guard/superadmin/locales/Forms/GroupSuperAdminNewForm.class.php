<?php

class groupSuperAdminNewForm extends mfForm {

    function configure() { 
         $this->setValidators(array(
            'name' => new mfValidatorName(), // @TODO define min max + messages           
        ));
        $this->validatorSchema->setPostValidator(new mfValidatorGroupExists());
    }
}


class groupsSuperAdminNewForm extends mfForm {

    function configure() { 
       $this->setDefault('groups_count', $this->getDefault('groups_count',2)); // Number of form fields by default 
       $this->embedFormForEach('groups',new groupSuperAdminNewForm(),$this->getDefault('groups_count')); 
       $this->setValidator('groups_count', new mfValidatorInteger(array('min'=>1,"max"=>10)));   // min/max form fields
       $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'checkGroupNames'))));
    }
    
    function checkGroupNames($validator,$values)
    {
        $checkin=array();
        $error=false;
        foreach ($values['groups'] as $count=>$form)
        {
            foreach ($form as $key=>$value)
            {
                try
                {
                      if (in_array($key,array('name')) && $value!="")
                      {        
                            if (isset($checkin[$value]))
                            {
                                $checkin[$value]=true; 
                                throw new mfValidatorError($this['groups'][$count]['name']->getValidator(),__('this {key} [{value}] already exists.'),array('key'=>$key,'value'=>$value));
                            }    
                            else
                               $checkin[$value]=false; 
                      }      
                  }   
                  catch (mfValidatorError $e)
                  {
                       $this['groups'][$count][$key]->setError($e);
                       $error=true;
                  }
              }  
        }  
        if ($error)
           throw new mfValidatorErrorSchema($validator,array("groups"=>new mfValidatorError($validator,"error")));  // Dummy Exception with no error
        return $values;
    }
}


 