<?php

class mfValidatorGroupExists extends mfValidatorBase {
    
    function configure($options = array(), $messages = array()) {
        parent::configure($options,$messages);
        $this->addOption('exist');
        $this->addMessage('exist', __('[{value}] already exists.'));
    }
    
    function doIsValid($value) {
        if (!$value['name'])
            return $value;
        $group=new Group($value);
        if ($group->isExist())
        {
            throw new mfValidatorErrorSchema($this, array(
                    'name' => new mfValidatorError($this, 'exist',array('value'=>$value['name'])),
            ));
        }    
        return $value;
    }
}

