<?php

class UserSuperAdminNewForm extends UserSuperAdminBaseForm {

     function configure()
     {
        parent::configure();
        $this->setValidator('is_secure_by_code',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO')));
        unset($this['id']);
     }
}