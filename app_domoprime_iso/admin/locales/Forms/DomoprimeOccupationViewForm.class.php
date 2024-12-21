<?php


require_once dirname(__FILE__)."/DomoprimeOccupationI18nForm.class.php";


class DomoprimeOccupationViewForm extends mfForm {
                 
    function configure()
    {
        $this->embedForm('occupation', new DomoprimeOccupationBaseForm($this->getDefault('occupation')));
        $this->embedForm('occupation_i18n', new DomoprimeOccupationI18nForm($this->getDefault('occupation_i18n')));
        unset($this->occupation_i18n['id'],$this->occupation['id']);
    }

}
