<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForms.class.php";        

class customers_meetings_forms_viewActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                 
        $meeting=$this->getParameter('meeting');             
        $this->form=new CustomerMeetingViewForms($this->getUser(),$meeting,array());  
        $this->user=$this->getUser();
    } 
    
    
}