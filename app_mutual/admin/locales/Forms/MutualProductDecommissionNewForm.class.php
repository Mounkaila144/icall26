<?php


class MutualProductDecommissionNewForm extends MutualProductDecommissionBaseForm {
      
    function configure()
    {
        parent::configure();
        unset($this['id']);
    }
}

