<?php

class userGroupsChangeForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
                   "selection"=>new mfValidatorSchemaForEach(new mfValidatorInteger() ,count($this->getDefault('selection'))),
                   "user"=>new mfValidatorInteger(),
                   "value"=> new mfValidatorBoolean()
                ));
       $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'reorganize'))));
    }
    
    function reorganize($validator,$values)
    {
        $values['value']=$values['value']?"YES":"NO";
        foreach ($values['selection'] as $index=>$item)
        {
            $values['usergroups'][$index]['id']=$item;
            $values['usergroups'][$index]['is_active']=$values['value'];
        }    
        return $values;
    }
}

