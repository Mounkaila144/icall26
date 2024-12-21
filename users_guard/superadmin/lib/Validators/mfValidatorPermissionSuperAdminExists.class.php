<?php

class mfValidatorPermissionSuperAdminExists extends mfValidatorBase {
    
    function configure($options = array(), $messages = array()) {
        parent::configure($options,$messages);
        $this->addOption('exist');
        $this->addMessage('exist', __('[{value}] already exists.'));
    }
    
    function doIsValid($value) {
        if (!$value['name'])
            return $value;
        $permission=new Permission($value);
        if ($permission->isExist())
        {
            throw new mfValidatorErrorSchema($this, array(
                    'name' => new mfValidatorError($this, 'exist',array('value'=>$value['name'])),
            ));
        }    
        return $value;
    }
}

