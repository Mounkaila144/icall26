<?php

class ConnectedAsUserForm extends mfForm {

    function configure()
    {
        $this->setValidators(array(
            'user_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>UserUtils::getActiveUsersSortedByLastnameForSelect()))
        ));
    }
}