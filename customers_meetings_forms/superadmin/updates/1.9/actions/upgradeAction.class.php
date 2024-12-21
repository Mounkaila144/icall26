<?php


class customers_meetings_forms_upgrade_19_Action extends mfModuleUpdate {
 
    function execute()
    {             
       GroupPermissionUtils::addAdminPermissionsForAllGroups(new mfArray(array("meeting_new_meeting_forms","meeting_view_meeting_forms")),$this->getSite());
    }
}

