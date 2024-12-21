<?php

    

class customers_meetings_forms_viewerActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                 
         $this->forms=new CustomerMeetingForms($this->getUser(),$this->getParameter('meeting'));                               
    } 
    
    
}