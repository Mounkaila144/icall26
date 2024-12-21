<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingRangeNewForm.class.php";

class customers_meetings_ajaxNewRangeI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();            
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('customers_meetings','ajaxListPartialRange');  
        }       
        $this->form= new CustomerMeetingRangeNewForm((string)$form['lang'],array());
        $this->item_i18n=new CustomerMeetingRangeI18n(array('lang'=>(string)$form['lang']));        
    }

}
