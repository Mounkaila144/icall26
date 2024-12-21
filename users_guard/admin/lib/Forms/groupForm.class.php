<?php

class groupForm extends groupBaseForm {

    function configure() {       
        parent::configure();
        $this->setValidator('id',new mfValidatorInteger());
    }
}