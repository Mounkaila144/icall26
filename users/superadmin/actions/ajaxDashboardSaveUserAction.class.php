<?php

require_once dirname(__FILE__)."/../locales/Forms/UserSuperAdminForm.class.php";

class users_ajaxDashboardSaveUserAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        try {
            $this->form = new UserSuperAdminForm();
            $this->user=new User($request->getPostParameter('User'));
            $this->form->bind($request->getPostParameter('User'));
            $this->formFile= new UserAccountPictureForm(); // Only to get token
            if ($this->form->isValid()) {                
                $this->user->add($this->form->getValues());
                if ($this->user->isExist())
                        throw new mfException (__("User already exists")); 
                $this->user->save();
                $messages->addInfo(__("User %s (%s) has been saved",array($this->user,$this->user->get('username'))));
                $this->forward('users','ajaxDashboardListPartial');
            }
            else
            {               
                $this->user->add($request->getPostParameter('User')); // Repopulate
                $messages->addError(__("Form has some errors."));
              //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
            }    
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }             
    }
}
