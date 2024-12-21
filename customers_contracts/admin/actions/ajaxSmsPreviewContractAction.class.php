<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractSmsPreviewForm.class.php";



class customers_contracts_ajaxSmsPreviewContractAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->form=new CustomerContractSmsPreviewForm();
        $this->form->bind($request->getPostParameter('PreviewSMSContractCustomer'));
        if ($this->form->isValid())            
        {
           try
          {               
            $this->sms=$this->getComponent('/customers_contracts/sms', array('COMMENT'=>false,
                                                                                'contract'=>$this->form->getContract(),
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
          //    var_dump($this->form->getErrorSchema()->getErrorsMessage());
        }    
    }

}
