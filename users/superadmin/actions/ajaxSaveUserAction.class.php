<?php

require_once dirname(__FILE__)."/../locales/Forms/UserForm.class.php";

class users_ajaxSaveUserAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
       
    function execute(mfWebRequest $request) {             
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();
        try {
            $this->form = new UserForm($this->getUser(),array(),$this->site);
            $this->user=new User($request->getPostParameter('User'),'admin',$this->site);           
            $this->form->bind($request->getPostParameter('User'));
            if ($this->form->isValid()) {
                $this->user->add($this->form->getValues());
                if ($this->user->isExist())
                   throw new mfException(__("User already exists."));                 
                $this->user->save();
                $messages->addInfo(__("User has been saved."));
                $this->forward('users','ajaxListPartial');
            }
            else
            {
                 $messages->addError(__("Form has some errors."));
                 $this->user->add($request->getPostParameter('User')); // Repopulate                   
            }    
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }             
    }
}
  