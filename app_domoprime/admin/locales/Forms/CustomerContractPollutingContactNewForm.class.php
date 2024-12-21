<?php


class CustomerContractPollutingContactNewForm extends CustomerContractPollutingContactBaseForm{
   
    function configure() {
        parent::configure();
        unset($this['id']);
    }
}
