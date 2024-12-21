<?php

require_once dirname(__FILE__)."/../locales/Forms/UserGroupSelectionForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/UserGroupAffectationProcessMultipleSelectionForm.class.php";


class users_guard_ajaxMultipleUpdateAffectationProcessAction extends mfAction {
  
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();          
         if (!$this->getUser()->hasCredential(array(array('superadmin','users_groups_multiple_process'))))
            $this->forwardTo401Action ();
        $this->user=$this->getUser();
        $this->form_multiple = new UserGroupSelectionForm($this->getUser(),$request->getPostParameter('UserGroupSelection'));                
        $this->form_multiple->bind($request->getPostParameter('UserGroupSelection'));
        try
        {
            if ($this->form_multiple->isValid())
            {
               $this->form = new UserGroupAffectationProcessMultipleSelectionForm($this->getUser());
               $this->form->setSelection($this->form_multiple->getSelection());
            }  
            else
            {
//                echo "<pre>"; var_dump($this->form_multiple->getErrorSchema()->getErrorsMessage()); echo "</pre>";
                $messages->addError(__("Form has some errors."));
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}

