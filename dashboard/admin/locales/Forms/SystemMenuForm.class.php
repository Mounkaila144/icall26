<?php

class SystemMenuForm extends SystemMenuBaseForm {
     
  
    function configure()
    {
          
        parent::configure();
     //   $this->setValidator('id', new mfValidatorInteger());
         unset($this['id']);
    }
}
