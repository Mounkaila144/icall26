<?php

class SiteOversightMessageEvents {
     
   // contracts.csv.export
    static function setContractCsvExport(mfEvent $event)
    {         
        $csv=$event->getSubject();
    // $csv=new CustomerContractExportCsvFilter();
        if (!mfModule::isModuleInstalled('site_oversight', $csv->getSite()))
             return ;
        if (!mfModule::isModuleInstalled('customers_contracts', $csv->getSite()))
             return ;                  
        SiteOversightMessage::getInstance()->addMessage('customers_contracts',
                                                        "ContractCSVExport",
                                                        __("Contract CSV Export",array(),'messages','site_oversight'),
                                                        $csv->getNumberOfItems(),
                                                        5,
                                                        $csv->getFilter()->getValues(),
                                                        $csv->getUser()->getGuardUser())->save();
    }
    
   // contracts.csv.export.extended
   static function setContractCsvExportExtended(mfEvent $event)
    {         
        $csv=$event->getSubject();
      //  $csv=new CustomerContractExportFormatCsvFilter();
        if (!mfModule::isModuleInstalled('site_oversight', $csv->getSite()))
             return ;
        if (!mfModule::isModuleInstalled('customers_contracts_exports', $csv->getSite()))
             return ;                  
        SiteOversightMessage::getInstance()->addMessage('customers_contracts_exports',
                                                        "ContractCSVExportExtended",
                                                        __("Contract CSV Export Extended",array(),'messages','site_oversight'),
                                                        $csv->getNumberOfItems(),
                                                        5,
                                                        $csv->getFilter()->getValues(),
                                                        $csv->getUser()->getGuardUser())->save();
    }
    
    // app.domoprime.billings.csv.export
    static function setIsoBillingCsvExport(mfEvent $event)
    {         
        $csv=$event->getSubject();
       // $csv=new DomoprimeBillingExportCsvFilter();
        if (!mfModule::isModuleInstalled('site_oversight', $csv->getSite()))
             return ;
        if (!mfModule::isModuleInstalled('app_domoprime', $csv->getSite()))
             return ;                  
        SiteOversightMessage::getInstance()->addMessage('app_domoprime',
                                                        "BillingCSVExport",
                                                        __("Billing CSV Export",array(),'messages','site_oversight'),                                                        
                                                        $csv->getNumberOfItems(),
                                                        5,
                                                        $csv->getFilter()->getValues(),
                                                        $csv->getUser()->getGuardUser())->save();
    }
    
    
    // app.domoprime.quotations.csv.export
    static function setIsoQuotationCsvExport(mfEvent $event)
    {         
        $csv=$event->getSubject();
      //  $csv=new DomoprimeQuotationExportCsvFilter();
        if (!mfModule::isModuleInstalled('site_oversight', $csv->getSite()))
             return ;
        if (!mfModule::isModuleInstalled('app_domoprime', $csv->getSite()))
             return ;                  
        SiteOversightMessage::getInstance()->addMessage('app_domoprime',
                                                        "QuotationCSVExport",
                                                        __("Quotation CSV Export",array(),'messages','site_oversight'),
                                                        $csv->getNumberOfItems(),
                                                        5,
                                                        $csv->getFilter()->getValues(),
                                                        $csv->getUser()->getGuardUser())->save();
    }
    
    
    // contracts.kml.export
    static function setContractKmlExport(mfEvent $event)
    {         
        $kml=$event->getSubject();
    // $kml=new CustomerContractExportKMLFilter();
        if (!mfModule::isModuleInstalled('site_oversight', $kml->getSite()))
             return ;
        if (!mfModule::isModuleInstalled('customers_contracts', $kml->getSite()))
             return ;                  
        SiteOversightMessage::getInstance()->addMessage('customers_contracts',
                                                        "Contract KML Export",
                                                        __("Contract KML Export",array(),'messages','site_oversight'),
                                                        $kml->getNumberOfItems(),
                                                        5,
                                                        $kml->getFilter()->getValues(),
                                                        $kml->getUser()->getGuardUser())->save();
    }
    
     // meetings.csv.export
    static function setMeetingCsvExport(mfEvent $event)
    {         
        $csv=$event->getSubject();
      //$csv=new CustomerMeetingExportCsvFilter();
        if (!mfModule::isModuleInstalled('site_oversight', $csv->getSite()))
             return ;
        if (!mfModule::isModuleInstalled('customers_meetings', $csv->getSite()))
             return ;                  
        SiteOversightMessage::getInstance()->addMessage('customers_meetings',
                                                        "MeetingCSVExport",
                                                        __("Meeting CSV Export",array(),'messages','site_oversight'),
                                                        $csv->getNumberOfItems(),
                                                        5,
                                                        $csv->getFilter()->getValues(),
                                                        $csv->getUser()->getGuardUser())->save();
    }
    
    
     // meetings.kml.export
    static function setMeetingKmlExport(mfEvent $event)
    {         
        $kml=$event->getSubject();        
     // $kml=new CustomerMeetingExportKMLFilter();
        if (!mfModule::isModuleInstalled('site_oversight', $kml->getSite()))
             return ;
        if (!mfModule::isModuleInstalled('customers_meetings', $kml->getSite()))
             return ;         
        SiteOversightMessage::getInstance()->addMessage('customers_meetings',
                                                        "Meeting KML Export",
                                                        __("Meeting KML Export",array(),'messages','site_oversight'),
                                                        $kml->getNumberOfItems(),
                                                        5,
                                                        $kml->getFilter()->getValues(),
                                                        $kml->getUser()->getGuardUser())->save();
    }
    
    // meetings.csv.export.extended
   static function setMeetingCsvExportExtended(mfEvent $event)
    {         
        $csv=$event->getSubject();
     //   $csv=new CustomerMeetingExportFormatCsvFilter();
        if (!mfModule::isModuleInstalled('site_oversight', $csv->getSite()))
             return ;
        if (!mfModule::isModuleInstalled('customers_meetings_exports', $csv->getSite()))
             return ;                  
        SiteOversightMessage::getInstance()->addMessage('customers_meetings_exports',
                                                        "MeetingCSVExportExtended",
                                                        __("Meeting CSV Export Extended",array(),'messages','site_oversight'),
                                                        $csv->getNumberOfItems(),
                                                        5,
                                                        $csv->getFilter()->getValues(),
                                                        $csv->getUser()->getGuardUser())->save();
    }
    
    
    static function setUserGroupPermissionAdd(mfEvent $event)
    {         
        $group_permissions=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $group_permissions->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users_guard',
                                                        "UserGroupPermissionAdd",
                                                        __("Permissions [%s] added to group [%s]",array($group_permissions->getPermissions()->getNames()->implode(),$event['group']->get('name')),'messages','site_oversight'),                                                        
                                                        5,                                                        
                                                        null)->save();  
    }
    
     static function setUserPermissionAdd(mfEvent $event)
    {         
        $user_permissions=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $user_permissions->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users',
                                                        "UserPermissionAdd",
                                                        __("Permissions [%s] added to user [%s]",array($user_permissions->getPermissions()->getNames()->implode(),strtoupper((string)$event['user'])),'messages','site_oversight'),                                                        
                                                        5,                                                        
                                                        $event['user'])->save();  
    }
    
     static function setUserGroupAdd(mfEvent $event)
    {         
        $user_groups=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $user_groups->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users',
                                                        "UserGroupAdd",
                                                        __("Groups [%s] added to user [%s]",array($user_groups->getGroups()->getNames()->implode(),strtoupper((string)$event['user'])),'messages','site_oversight'),                                                        
                                                        5,                                                        
                                                        $event['user'])->save();  
    }
    
    static function setUserChange(mfEvent $event)
    {                     
        $user =$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $user ->getSite()))
             return ;        
        if (!in_array($event->getParameters(),array('enable','validate','password.created')))
            return ;
        $message="";
      //  var_dump($event->getParameters(),$user->get('is_active'),$user->get('status'));
        if ($event->getParameters()=='enable' && $user->get('status')=='ACTIVE')
            $message=__("User [%s] enabled",(string)$user,'messages','site_oversight');                                     
        elseif ($event->getParameters()=='validate' && $user->get('is_active')=='YES')
            $message=__("User [%s] validated",(string)$user,'messages','site_oversight');  
         elseif ($event->getParameters()=='password.created')
            $message=__("User [%s] password changed",(string)$user,'messages','site_oversight');  
         elseif ($event->getParameters()=='profile')
            $message=__("User [%s] profile changed [%s]",[(string)$user,$user->getProfile()->getProfile()->getI18n()],'messages','site_oversight');  
        if (!$message)
            return ;                
        SiteOversightUserAction::getInstance()->addMessage('users',
                                                        "UserChange",
                                                        $message,
                                                        5,                                                        
                                                        mfContext::getInstance()->getUser()->getGuardUser())->save();  
    }
    
      static function setUserPermissionDelete(mfEvent $event)
    {         
        $user_permission=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $user_permission->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users',
                                                        "UserPermissionDelete",
                                                        __("Permission [%s] deleted to user [%s]",array($user_permission->getPermission()->get('name'),strtoupper((string)$event['user'])),'messages','site_oversight'),                                                        
                                                        5,                                                        
                                                        $event['user'])->save();  
    }
    
     static function setUserPermissionsDelete(mfEvent $event)
    {         
        $user_permissions=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $user_permissions->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users',
                                                        "UserPermissionsDelete",
                                                        __("Permissions [%s] deleted to user [%s]",array($user_permissions->getPermissions()->getNames()->implode(),strtoupper((string)$event['user'])),'messages','site_oversight'),                                                        
                                                        5,                                                        
                                                        $event['user'])->save();  
    }
    
    static function setUserGroupDelete(mfEvent $event)
    {         
        $userGroup=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $userGroup->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users',
                                                        "UserGroupDelete",
                                                        __("Group [%s] deleted to user [%s]",array($userGroup->getGroup()->get('name'),strtoupper((string)$event['user'])),'messages','site_oversight'),                                                        
                                                        5,                                                        
                                                        $event['user'])->save();  
    }
    
    
    static function setPermissionDelete(mfEvent $event)
    {         
        $permission=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $permission->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users_guard',
                                                        "PermissionDelete",
                                                        __("Permission [%s] deleted",$permission->get('name'),'messages','site_oversight'),                                                        
                                                        5 ,                                                       
                                                        null)->save();  
    }
    
     static function setPermissionsDelete(mfEvent $event)
    {         
        $permissions=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $permissions->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users_guard',
                                                        "PermissionsDelete",
                                                        __("Permissions [%s] deleted",$permissions->getNames()->implode(),'messages','site_oversight'),                                                        
                                                        5 ,                                                       
                                                        null)->save();  
    }
    
    
    static function setGroupImport(mfEvent $event)
    {         
        $csv=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $csv->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users_guard',
                                                        "GroupImport",
                                                        __("Group %s has been imported",$csv->getGroup()->get('name'),'messages','site_oversight'),                                                        
                                                        5 ,                                                       
                                                        null)->save();  
    }
    
    
    static function setGroupPermissionsImport(mfEvent $event)
    {         
        $csv=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $csv->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users_guard',
                                                        "GroupPermissionImport",
                                                        __("Group %s , permissions have been imported",$csv->getGroup()->get('name'),'messages','site_oversight'),                                                        
                                                        5 ,                                                       
                                                        null)->save();  
    }
    
    
     static function setGroupCopy(mfEvent $event)
    {         
        $group=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $group->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users_guard',
                                                        "GroupCopy",
                                                        __("Group %s has been copied",$group->get('name'),'messages','site_oversight'),                                                        
                                                        5 ,                                                       
                                                        null)->save();  
    }
    
    static function setGroupChange(mfEvent $event)
    {         
        $group=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $group->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users_guard',
                                                        "GroupChange",
                                                        __("Group %s state has been changed %s",[$group->get('name'),$group->set('is_active')],'messages','site_oversight'),                                                        
                                                        5 ,                                                       
                                                        null)->save();  
    }
    
     static function setGroupReAffect(mfEvent $event)
    {         
        $group=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $group->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users_guard',
                                                        "GroupReaffect",
                                                        __("Group %s has been reaffected to %s",[$group->get('name'),$event['group']->get('name')],'messages','site_oversight'),                                                        
                                                        5 ,                                                       
                                                        null)->save();  
    }
    
     static function setGroupPermissionDelete(mfEvent $event)
    {         
        $group_permission=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $group_permission->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users_guard',
                                                        "GroupPermissionDelete",
                                                        __("Group %s, permission %s has been deleted",[$group_permission->getGroup()->get('name'),$group_permission->getPermission()->get('name')],'messages','site_oversight'),                                                        
                                                        5 ,                                                       
                                                        null)->save();  
    }
    
    
     static function setUserGroupChange(mfEvent $event)
    {         
        $user_group=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $user_group->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users_guard',
                                                        "UserGroupChange",
                                                        __("Group %s for user [%s] has been changed [%s]",[$user_group->getGroup()->get('name'),(string)$user_group->getUser(),$user_group->get('is_active')],'messages','site_oversight'),                                                        
                                                        5 ,                                                       
                                                        $user_group->getUser())->save();  
    }
    
     
     static function setGroupExport(mfEvent $event)
    {         
        $csv=$event->getSubject();    
        if (!mfModule::isModuleInstalled('site_oversight', $csv->getSite()))
             return ;                   
          SiteOversightUserAction::getInstance()->addMessage('users_guard',
                                                        "GroupExport",
                                                        __("Group %s has been exported",[$csv->getGroup()->get('name')],'messages','site_oversight'),                                                        
                                                        5 ,                                                       
                                                        null)->save();  
    }
}

