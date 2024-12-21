<?php

class UserForm extends UserBaseForm {

    function configure()
    {
        parent::configure();    
        $this->setValidator('is_secure_by_code',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));
        unset($this['team_id']);
    }
}