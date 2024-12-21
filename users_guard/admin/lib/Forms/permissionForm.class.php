<?php

class permissionForm extends permissionBaseForm {

    function configure() {       
        parent::configure();
      /*  $this->setValidators(array(
            'id' => new mfValidatorInteger(), 
            'name' => new mfValidatorName(), // @TODO define min max + messages
        ));*/
        $this->setValidator('id',new mfValidatorName()); // @TODO define min max + messages
    }
}