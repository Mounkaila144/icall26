<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingEmailPreviewForm.class.php";



class customers_meetings_ajaxEmailPreviewMeetingAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->form=new CustomerMeetingEmailPreviewForm();
        $this->form->bind($request->getPostParameter('PreviewEmailCustomer'));
        if ($this->form->isValid())            
        {
           try
          {               
            $this->email=$this->getComponent('/customers_meetings/email', array('COMMENT'=>false,
                                                                                'meeting'=>$this->form->getMeeting(),
                                                                                'model_i18n'=>$this->form->getModelI18n()))->getContent();                   
          }
          catch (SmartyCompilerException $e)
          {
              trigger_error($e->getMessage());
              throw new mfException(__("Error Syntax in model."));              
          }
        }    
        else
        {
            $messages->addError(__('Form has some errors.'));
        }    
    }

}
