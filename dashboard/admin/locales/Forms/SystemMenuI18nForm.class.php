<?php

class SystemMenuI18nForm extends SystemMenuI18nBaseForm {
     
      
    function configure()
    {
        parent::configure();
        $this->setValidator('menu_id', new mfValidatorInteger());
    }
}
