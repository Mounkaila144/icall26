<?php



class customers_meetings_meetingNavigationJSActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                   
        if (!$this->getUser()->hasCredential(array(array('superadmin','admin','meeting_navigation'))))
           return mfView::NONE;   
    } 
    
    
}