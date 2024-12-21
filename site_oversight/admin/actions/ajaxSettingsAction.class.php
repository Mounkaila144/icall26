<?php


class site_oversight_ajaxSettingsAction extends mfAction {

     
    function execute(mfWebRequest $request) {
         $messages = mfMessages::getInstance();                     
          
        $this->settings= new SiteOversightSettings();   
        $this->form=new SiteOversightSettingsForm($request->getPostParameter('Settings'));        
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
                $this->forward($this->getModuleName(),'ajaxListPartialMessage');
            }
            else
            {          
             //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
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

