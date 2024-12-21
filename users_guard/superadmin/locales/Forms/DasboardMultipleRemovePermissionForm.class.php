<?php

require_once __DIR__."/DasboardMultipleRemovePermissionSitesForm.class.php";

class DasboardMultipleRemovePermissionForm extends DasboardMultipleRemovePermissionSitesForm {

    
   
    
    function configure() {    
        parent::configure();
        $this->setValidator('permissions',new mfValidatorMultiple(new mfValidatorString(array('trim'=>true))));           
    }
          
    
    function getPermissions()
    {
         return $this['permissions']->getValue();                   
    }
 
}