<?php

class GroupNewForm extends groupBaseForm {

   function configure() { 
        parent::configure();    
     //   $this->setDefault('application','admin');
     //   $this->setValidator('application', new mfValidatorChoice(array("choices" => array("admin", "frontend"))));
        unset($this['id']);
    }

}