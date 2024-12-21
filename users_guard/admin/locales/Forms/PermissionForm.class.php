<?php

class PermissionForm extends PermissionBaseForm {

    function configure() {       
        parent::configure();
      /*  $this->setValidators(array(
            'id' => new mfValidatorInteger(), 
            'name' => new mfValidatorName(), // @TODO define min max + messages
        ));*/
        $this->setValidator('id',new mfValidatorName()); // @TODO define min max + messages
        $this->setValidator('group_id',new mfValidatorChoice(array("required"=>false,"key"=>true,"choices"=>array(0=>"")+PermissionGroupUtils::getPermissionsGroupForI18nSelect()))); 
    }
}