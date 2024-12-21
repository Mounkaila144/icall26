<?php

require_once __DIR__."/../locales/Forms/DomoprimeSystemSettingsForm.class.php";

class app_domoprime_ajaxSystemAction extends mfAction {


    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();     
        $this->form=new DomoprimeSystemSettingsForm($this->getUser());
        if (!$request->getPostParameter('SystemSettings'))
            return ;
        try
        {
            $this->form->bind($request->getPostParameter('SystemSettings'));
            if ($this->form->isValid())
            {
                $this->form->process();
                $messages->addInfo(__('Process has been done.'));
            }   
            else
            {
                $messages->addError(__('Form has some errors.'));
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }
}    