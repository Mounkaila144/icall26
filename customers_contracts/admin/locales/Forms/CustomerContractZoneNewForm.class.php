<?php


class CustomerContractZoneNewForm extends CustomerContractZoneFormBase{
     
    
    function configure()
    {
        parent::configure();
        unset($this['id']);
    }
}
