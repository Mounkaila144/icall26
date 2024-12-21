<?php



class app_domoprime_AfterWorkPolluterDocumentForViewMeetingActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
         //$contract=$this->getParameter('contract');
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_meeting_view_afterwork_document'))))  
                return mfView::NONE;
    } 
    
    
}