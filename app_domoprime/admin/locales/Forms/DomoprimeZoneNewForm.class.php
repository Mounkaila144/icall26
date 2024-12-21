<?php


class DomoprimeZoneNewForm extends DomoprimeZoneFormBase {
 
   function configure()
    {
        parent::configure();
        unset($this['id']);
    }

}



