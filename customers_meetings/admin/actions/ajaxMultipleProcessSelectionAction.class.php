<?php

require_once dirname(__FILE__)."/../locales/Forms/MultipleMeetingProcessSelectionForm.class.php";


class customers_meetings_ajaxMultipleProcessSelectionAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();            
        $this->user=$this->getUser();
        $this->form=new MultipleMeetingProcessSelectionForm($this->getUser(),$request->getPostParameter('MultipleMeetingSelection'));
        $this->form->bind($request->getPostParameter('MultipleMeetingSelection'));
        try
        {
            if ($this->form->isValid())  
            {     
                //var_dump($this->form->getValues());           
                if (!$this->form->hasActions())
                   $messages->addWarning(__("No action for selection.")); 
                if ($this->form->hasAction('created_at'))
                    $messages->addInfo(__("Meeting date creation has been modified on selection."));
                if ($this->form->hasAction('in_at'))
                    $messages->addInfo(__("Meeting date has been modified on selection."));
                if ($this->form->hasAction('sale1'))
                    $messages->addInfo(__("Sale 1 has been modified on selection."));
                if ($this->form->hasAction('sale2'))
                    $messages->addInfo(__("Sale 2 has been modified on selection."));
                if ($this->form->hasAction('telepro'))
                    $messages->addInfo(__("Telepro has been modified on selection."));
                if ($this->form->hasAction('state'))
                    $messages->addInfo(__("State has been modified on selection."));
                if ($this->form->hasAction('assistant'))
                    $messages->addInfo(__("Assistant has been modified on selection."));
                if ($this->form->hasAction('sms_customer'))
                    $messages->addInfo(__("SMS have been sent to selection."));
                if ($this->form->hasAction('campaign'))
                    $messages->addInfo(__("Campaign has been modified on selection."));
                if ($this->form->hasAction('type'))
                    $messages->addInfo(__("Type has been modified on selection."));
                 if ($this->form->hasAction('products_by_default'))
                    $messages->addInfo(__("Products by default has been done on selection."));                     
                $return=CustomerMeetingUtils::processSelection($this->form['actions']->getValue(),$this->form->getSelection(),$this->form->getValues(),$this->getUser());                           
                if ($return)
                {    
                   foreach ($return as $message) $messages->addInfo($message);
                }  
                
                $multiple=new CustomerMeetingMultipleProcess($this->form['actions']->getValue(),$this->form->getSelection(),$this->form->getValues(),$this->getUser());
                $multiple->process();  
                mfContext::getInstance()->getEventManager()->notify(new mfEvent( $multiple, 'meetings.multiple.process'));                         
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
