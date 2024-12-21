<?php

class app_domoprime_iso_BtnMigrateForMeetingActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
         if (!$this->getUser()->hasCredential(array(array('superadmin'))))    
             return mfView::NONE;
    } 
    
    
}