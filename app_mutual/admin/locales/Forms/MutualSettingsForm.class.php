<?php

class MutualSettingsForm extends mfForm {

    function configure() {
        $this->setValidators(array(
            "nb_days_to_add"=> new mfValidatorInteger(array("min"=>0)),//max ???
            "nb_meetings_to_process"=> new mfValidatorInteger(array("min"=>5)),//max ???
        ));
    }
}


