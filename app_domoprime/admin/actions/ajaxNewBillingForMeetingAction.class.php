<?php

//require_once dirname(__FILE__)."/../locales/Forms/DomoprimeClassNewForm.class.php";

class app_domoprime_ajaxNewBillingForMeetingAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
         $this->user=$this->getUser();
        $this->meeting=$request->getRequestParameter('meeting',new CustomerMeeting($request->getPostParameter('Meeting')));
        if ($this->meeting->isNotLoaded())
            return ;
      //  $this->form= new DomoprimeClassNewForm((string)$form['lang']);
      //  $this->item_i18n=new DomoprimeClassI18n(array('lang'=>(string)$form['lang']));        
    }

}
