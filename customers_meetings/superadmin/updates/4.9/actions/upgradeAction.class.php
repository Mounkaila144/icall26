<?php


class customers_meetings_upgrade_49_Action extends mfModuleUpdate {
 
    function execute()
    {      
      GroupPermissionUtils::addAdminPermissionsForAllGroups(new mfArray(array("meeting_view_treated_at_modified_by_status_change")),$this->getSite());       
    }
}

