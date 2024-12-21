<?php



class app_domoprime_PreMeetingPolluterDocumentForViewMeetingActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
         //$contract=$this->getParameter('contract');
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_meeting_view_premeeting_document'))))  
                return mfView::NONE;
    } 
    
    
}