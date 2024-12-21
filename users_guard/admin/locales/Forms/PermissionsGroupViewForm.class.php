<?php


require_once dirname(__FILE__)."/PermissionsGroupI18nForm.class.php";


class PermissionsGroupViewForm extends mfForm {
      
   
            
    function configure()
    {
        $this->embedForm('group', new PermissionsGroupBaseForm($this->getDefault('group')));
        $this->embedForm('group_i18n', new PermissionsGroupI18nForm($this->getDefault('group_i18n')));
        unset($this->group_i18n['id'],$this->group['id']);
    }

   
}
