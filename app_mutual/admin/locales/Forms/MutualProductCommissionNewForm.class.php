<?php


class MutualProductCommissionNewForm extends MutualProductCommissionBaseForm {
      
    function configure()
    {
        parent::configure();
        unset($this['id']);
    }
}

