<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormNewForm.class.php";

class customers_meetings_forms_ajaxNewFormI18nAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('customers_meetings_forms','ajaxListPartialForm');  
        }       
        $this->form= new CustomerMeetingFormNewForm((string)$form['lang'],array());
        $this->item=new CustomerMeetingFormI18n(array('lang'=>(string)$form['lang']));        
    }

}
