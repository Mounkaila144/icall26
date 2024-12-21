<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsNavigationFormFilter.class.php";


class customers_meetings_meetingNavigationActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                   
        $messages = $this->getMessage();            
        if (!$this->getUser()->hasCredential(array(array('superadmin','admin','meeting_navigation'))))
           return mfView::NONE;     
        $this->formFilter= new CustomerMeetingsNavigationFormFilter($this->getUser()); 
        $this->formFilter->bind($request->getPostParameter('filter'));
        if ($this->formFilter->isValid())
            $this->formFilter->execute();
        $this->JS=$this->getParameter('JS');                
      //  else var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());       
    } 
    
    
}