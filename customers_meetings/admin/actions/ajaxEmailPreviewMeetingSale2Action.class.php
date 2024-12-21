<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingEmailPreviewSaleForm.class.php";



class customers_meetings_ajaxEmailPreviewMeetingSale2Action extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->form=new CustomerMeetingEmailPreviewSaleForm();
        $this->form->bind($request->getPostParameter('PreviewEmailSale'));
        if ($this->form->isValid())            
        {
          try
          {               
            $this->email=$this->getComponent('/customers_meetings/emailForSale', array('COMMENT'=>false,
                                                                                'meeting'=>$this->form->getMeeting(),
                                                                                'user'=>$this->form->getMeeting()->getSale2(),
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
          //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
            
        }    
    }

}
