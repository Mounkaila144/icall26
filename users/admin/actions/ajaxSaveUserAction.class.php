<?php

require_once dirname(__FILE__)."/../locales/Forms/UserForm.class.php";

class users_ajaxSaveUserAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {                  
        $messages = mfMessages::getInstance();
        try {
            $this->form = new UserForm($this->getUser(),$request->getPostParameter('User'));
            $this->getEventDispather()->notify(new mfEvent($this->form, 'user.view.config')); 
            $this->user=$this->getUser();
            $this->item=new User($request->getPostParameter('User'),'admin');         
            if (!$this->item->isAuthorized('view'))
                 $this->forwardTo401Action();  
            $this->form->bind($request->getPostParameter('User'));
            if ($this->form->isValid()) {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                   throw new mfException(__("User already exists."));      
                $this->getEventDispather()->notify(new mfEvent($this->item, 'user.change.before',['form'=>$this->form])); 
                $this->item->save();
                $this->getEventDispather()->notify(new mfEvent($this->item, 'user.change',['form'=>$this->form])); 
                $messages->addInfo(__("User [%s] has been updated.",(string)$this->item));
                $this->forward('users','ajaxListPartial');
            }
            else
            {
                 $messages->addError(__("Form has some errors."));
                 $this->item->add($request->getPostParameter('User')); // Repopulate                 
            }    
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }     
        $this->user_settings=  UserSettings::load();
    }
}
  