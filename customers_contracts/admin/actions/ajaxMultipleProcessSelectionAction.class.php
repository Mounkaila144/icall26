<?php

require_once dirname(__FILE__)."/../locales/Forms/MultipleContractProcessSelectionForm.class.php";


class customers_contracts_ajaxMultipleProcessSelectionAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                        
        $this->user=$this->getUser();
        $this->form=new MultipleContractProcessSelectionForm($this->getUser(),$request->getPostParameter('MultipleContractSelection'));        
        $this->form->bind($request->getPostParameter('MultipleContractSelection'));
        try
        {
            if ($this->form->isValid())  
            {     
              //  var_dump($this->form->getValues());                         
                if ($this->form->hasAction('state'))
                    $messages->addInfo(__("State has been modified on selection."));              
                if ($this->form->hasAction('sms_customer'))
                    $messages->addInfo(__("SMS have been sent to selection."));  
                $multiple=new CustomerContractMultipleProcess($this->form['actions']->getValue(),$this->form->getSelection(),$this->form->getValues(),$this->getUser());
                $multiple->process();              
                mfContext::getInstance()->getEventManager()->notify(new mfEvent( $multiple, 'contracts.multiple.process'));                         
                if ($multiple->hasMessages())
                    $messages->addInfos($multiple->getMessages());      
                if ($multiple->hasErrors())
                    $messages->addErrors($multiple->getErrors()); 
            }  
            else
            {
               // var_dump($this->form->getErrorSchema()->getErrorsMessage());
                //var_dump($this->form->getDefaults());
              //  echo "<pre>"; var_dump($request->getPostParameter('MultipleMeetingSelection')); echo "</pre>";
                $messages->addError(__("Form has some errors."));
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
