<?php


class CustomerMeetingImportGoogleSheetFilterFormBase extends mfForm {
    function __construct($defaults = array()) {
        parent::__construct($defaults);
    }

    function configure() {
        $this->setOption('disabledCSRF',true);
        $this->setValidators(array(
            "format_id"=>new mfValidatorInteger(array('required' => true,'empty_value' => false)),
            "offset"=>new mfValidatorInteger(array('required' => false)),
        ));
    }


}

