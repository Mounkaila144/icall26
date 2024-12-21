<?php



 class old_SystemMenuForm extends SystemMenuBaseForm {
 
    function configure()
    {
        die();
        parent::configure();
        unset($this['id']);
    }

    
 
}


