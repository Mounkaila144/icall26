<?php

class partners_ajaxSettingsAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->settings= new PartnerSettings();                           
        $this->form=new PartnerSettingsForm();           
        if (!$request->getPostParameter('Settings'))
           return ;
        try 
        {               
            $this->form->bind($request->getPostParameter('Settings'));
            if ($this->form->isValid())
            {                                     
                $this->settings->add($this->form->getValues());
                $this->settings->save();
                $messages->addInfo(__("Settings have been saved."));
                $this->forward('site','ajaxHome');
            }
            else
            {          
           //     var_dump($this->form->getErrorSchema()->getErrorsMessage());
              $messages->addError(__('Settings has some errors.'));
              $this->settings->add($request->getPostParameter('Settings')); // Repopulate
            }  
        }
        catch (mfException $e)
        {
          $messages->addError($e);
        }             
    }

}
