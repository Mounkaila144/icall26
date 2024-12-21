<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingSmsPreviewForm.class.php";



class customers_meetings_ajaxSmsPreviewMeetingAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->form=new CustomerMeetingSmsPreviewForm();
        $this->form->bind($request->getPostParameter('PreviewSMSCustomer'));
        if ($this->form->isValid())            
        {
           try
          {               
            $this->sms=$this->getComponent('/customers_meetings/sms', array('COMMENT'=>false,
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
