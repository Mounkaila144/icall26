<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimePolluterModelAfterWorkForm.class.php";

class app_domoprime_ajaxSaveAfterWorkModelForPolluterAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();        
        $this->polluter=new PartnerPolluterCompany($request->getPostParameter('Polluter'));
        if ($this->polluter->isNotLoaded())
            return ;
        $this->form= new DomoprimePolluterModelAfterWorkForm();
        $this->item=new DomoprimePolluterAfterWork($this->polluter);
        $this->form->bind($request->getPostParameter('AfterWorkModelForPolluter'));
        if ($this->form->isValid())
        {
            $this->item->add($this->form->getValues())->save();
            $messages->addInfo(__('After work model has been updated.'));
            $this->forward('app_domoprime', 'ajaxListPartialPollutingCompany');
        }   
        else
        {    
            $messages->addError(__('Form has some errors.'));
        }
        
    }

}
