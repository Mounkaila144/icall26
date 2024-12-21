<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewFormsForContractForm.class.php";        

class customers_meetings_forms_ajaxSaveFormsForContractAction extends mfAction {
    
           
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();       
        $this->contract=new CustomerContract($request->getPostParameter('ContractForms'));
        if ($this->contract->isNotLoaded())
            return ;
        $this->form=new CustomerMeetingViewFormsForContractForm($this->getUser(),$this->contract,$request->getPostParameter('ContractForms'));           
        if (!$this->form->hasFields() && $this->contract->isHold())
        {
            $messages->addWarning(__('Contract is hold.')); 
            return ;
        }
        try
        {                
            $this->form->bind($request->getPostParameter('ContractForms'));
            if ($this->form->isValid())
            {              
                $this->form->getForms();                                              
                $this->form->getForms()->save();
                $this->getEventDispather()->notify(new mfEvent($this->form->getForms(), 'meeting.form.update'));  
                $messages->addInfo(__("Information has been saved."));              
            }   
            else
            {               
                // Repopulate               
                $messages->addError(__("Form has some errors."));   
               // var_dump($this->form->getErrorSchema()->getErrorsMessage());
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }           
    }

}
