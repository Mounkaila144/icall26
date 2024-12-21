<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormForm.class.php";
 
class customers_meetings_forms_ajaxSaveFormFieldsAction extends mfAction {
    
    
        
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();       
        $this->item=new CustomerMeetingFormI18n($request->getPostParameter('CustomerMeetingFormI18n'));          
        $this->form=new CustomerMeetingFormForm($request->getPostParameter('CustomerMeetingFormFields',$this->item->getDefaultFormfields()));        
        //var_dump($request->getPostParameter('CustomerMeetingFormFields'));
        if ($request->isMethod('POST') && $request->getPostParameter('CustomerMeetingFormFields'))
        {
           $this->form->bind($request->getPostParameter('CustomerMeetingFormFields')); 
           if ($this->form->isValid())
           {     
               $this->item->updateFormFields($this->form->getValue('fields'));              
               $messages->addInfo(__("Form has been saved."));
           }    
           else
           {               
               $messages->addError(__('Form has some errors.'));               
             //  var_dump($this->form->getErrorSchema()->getErrorsMessage());             
           }
        }   
   }

}

