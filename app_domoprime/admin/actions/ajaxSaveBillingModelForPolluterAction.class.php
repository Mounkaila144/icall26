<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimePolluterModelBillingForm.class.php";

class app_domoprime_ajaxSaveBillingModelForPolluterAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();        
        $this->polluter=new PartnerPolluterCompany($request->getPostParameter('Polluter'));
        if ($this->polluter->isNotLoaded())
            return ;
        $this->form= new DomoprimePolluterModelBillingForm();
        $this->item=new DomoprimePolluterBilling($this->polluter);
        $this->form->bind($request->getPostParameter('BillingModelForPolluter'));
        if ($this->form->isValid())
        {
            $this->item->add($this->form->getValues())->save();
            $messages->addInfo(__('Billing model has been updated.'));
            $this->forward('app_domoprime', 'ajaxListPartialPollutingCompany');
        }   
        else
        {    
            $messages->addError(__('Form has some errors.'));
        }
        
    }

}
