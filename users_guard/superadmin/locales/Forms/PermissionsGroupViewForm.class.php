<?php


require_once dirname(__FILE__)."/PermissionsGroupI18nForm.class.php";


class PermissionsGroupViewForm extends mfFormSite {
      
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
            
    function configure()
    {
        $this->embedForm('group', new PermissionsGroupBaseForm($this->getDefault('group')));
        $this->embedForm('group_i18n', new PermissionsGroupI18nForm($this->getDefault('group_i18n'),$this->getSite()));
        unset($this->group_i18n['id'],$this->group['id']);
    }

   
}
