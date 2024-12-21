<?php

class GroupNewForm extends GroupBaseForm {

   function configure() { 
        parent::configure();    
        unset($this['id']);
    }

}