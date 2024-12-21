<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimePolluterModelQuotationForm.class.php";

class app_domoprime_ajaxSaveQuotationModelForPolluterAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();        
        $this->polluter=new PartnerPolluterCompany($request->getPostParameter('Polluter'));
        if ($this->polluter->isNotLoaded())
            return ;
        $this->form= new DomoprimePolluterModelQuotationForm();
        $this->item=new DomoprimePolluterQuotation($this->polluter);
        $this->form->bind($request->getPostParameter('QuotationModelForPolluter'));
        if ($this->form->isValid())
        {
            $this->item->add($this->form->getValues())->save();
            $messages->addInfo(__('Quotation model has been updated.'));
            $this->forward('app_domoprime', 'ajaxListPartialPollutingCompany');
        }   
        else
        {    
            $messages->addError(__('Form has some errors.'));
        }
        
    }

}
