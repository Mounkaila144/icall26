<?php

class dashboard_notificationsManagerActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
        if (!$this->getUser()->hasCredential(array(array('superadmin','dashboard_notification_manager'))))
           return mfView::NONE;
    } 
    
    
}