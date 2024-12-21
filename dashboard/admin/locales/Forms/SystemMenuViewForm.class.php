<?php


require_once dirname(__FILE__)."/SystemMenuI18nForm.class.php";


class SystemMenuViewForm extends mfForm {
                 
    function configure()
    {
        $this->embedForm('menu', new SystemMenuBaseForm($this->getDefault('menu')));
        $this->embedForm('menu_i18n', new SystemMenuI18nForm($this->getDefault('menu_i18n')));
        unset($this->menu_i18n['id'],$this->menu['id']);
    }

}
