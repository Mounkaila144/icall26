<?php


class customers_meetings_forms_ajaxFilterSettingsAction extends mfAction {
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();       
        $this->settings= new CustomerMeetingFormsSettings();         
        if ($this->settings->get('fields_feature')!='YES')        
            $this->forwardTo401Action();        
        if (!$this->settings->isAvailable())          
           $messages->addWarning(__("Schema/Data are not built."));        
        $this->form=new CustomerMeetingFormsFilterSettingsForm($this->settings,$request->getPostParameter('Settings'));         
        if (!$request->isMethod('POST') || !$request->getPostParameter('Settings'))
            return ;     
        try 
        {               
            $this->form->bind($request->getPostParameter('Settings'));
            if ($this->form->isValid())
            {
               // echo "<pre>"; var_dump($this->form->getColumns()); echo "</pre>";                                    
                $this->settings->add($this->form->getColumns());
                $this->settings->save();
                $messages->addInfo(__("Settings have been saved."));
            }
            else
            {
              //var_dump($this->form->getErrorSchema()->getErrorsMessage());
              $messages->addError(__('Form has somme errors.'));
              $this->settings->add($request->getPostParameter('Settings')); // Repopulate
            }  
        }
        catch (mfException $e)
        {
          $messages->addError($e);
        }         
    }

}