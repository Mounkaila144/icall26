<?php


require_once dirname(__FILE__)."/DomoprimeTypeLayerI18nForm.class.php";


class DomoprimeTypeLayerViewForm extends mfForm {
                 
    function configure()
    {
        $this->embedForm('type', new DomoprimeTypeLayerBaseForm($this->getDefault('type')));
        $this->embedForm('type_i18n', new DomoprimeTypeLayerI18nForm($this->getDefault('type_i18n')));
        unset($this->type_i18n['id'],$this->type['id']);
    }

}
