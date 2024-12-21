<?php


class users_ajaxAccountIdentitySaveAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        try 
        {       
            $this->form = new userAccountForm();
            $this->user=$this->context->getUser()->getGuardUser(); 
            $this->form->bind($request->getPostParameter('user'),$request->getFiles());
            if ($this->form->isValid()) {               
               $this->user->add($this->form->getValues());                 
               $this->user->encryptPassword();                    
               $this->user->save();
               if ($this->form->hasValue('picture'))
                   $this->form->getValue('picture')->save(mfConfig::get('mf_site_app_dir')."/data/users/".$this->user->get('id')."/");
               $messages->addInfo(__("user %s (%s) has been saved",array($this->user,$this->user->get('username'))));
            }
            else
            {                   
               $this->user->add($request->getPostParameter('user')); // Repopulate
               $messages->addErrors($this->form->getErrorSchema()->getGlobalErrors());
            }   
        }    
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
        
    }
}
