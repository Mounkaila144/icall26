<?php


class MutualProductNewForm extends MutualProductBaseForm {
      
    function configure()
    {
        parent::configure();
        unset($this['id']);
    }
}

