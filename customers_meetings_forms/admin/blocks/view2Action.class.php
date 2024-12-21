<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForms.class.php";        

class customers_meetings_forms_view2ActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {         
        $meeting=$this->getParameter('meeting'); 
        $form=$this->getParameter('form'); 
        $this->form_extra=new CustomerMeetingViewForms($this->getUser(),$meeting,$form->getDefault('extra'));         
    } 
    
    
}