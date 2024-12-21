<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimePolluterModelPreMeetingForm.class.php";

class app_domoprime_ajaxSavePreMeetingModelForPolluterAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();        
        $this->polluter=new PartnerPolluterCompany($request->getPostParameter('Polluter'));
        if ($this->polluter->isNotLoaded())
            return ;
        $this->form= new DomoprimePolluterModelPreMeetingForm();
        $this->item=new DomoprimePolluterPreMeeting($this->polluter);
        $this->form->bind($request->getPostParameter('PreMeetingModelForPolluter'));
        if ($this->form->isValid())
        {
            $this->item->add($this->form->getValues())->save();
            $messages->addInfo(__('Pre Meeting model has been updated.'));
            $this->forward('app_domoprime', 'ajaxListPartialPollutingCompany');
        }   
        else
        {    
            $messages->addError(__('Form has some errors.'));
        }
        
    }

}
