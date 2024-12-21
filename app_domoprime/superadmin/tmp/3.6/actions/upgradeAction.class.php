<?php


class app_domoprime_upgrade_36_Action extends mfModuleUpdate {
 
    function execute()
    {             
       GroupPermissionUtils::processPermissionPermutation($this->getSite());              
    }
}

