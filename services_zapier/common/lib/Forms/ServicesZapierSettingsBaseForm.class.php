<?php

class ServicesZapierSettingsBaseForm extends mfForm
{

    function configure()
    {
        $this->setValidators(array(
                "client_id"=>new mfValidatorString(array("required"=>true)),
                "client_secret"=>new mfValidatorString(array("required"=>true)),
                "redirect_uri"=>new mfValidatorString(array("required"=>true)),
            )
        );
    }




}


