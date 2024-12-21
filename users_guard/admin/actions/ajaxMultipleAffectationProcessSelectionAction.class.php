<?php

require_once dirname(__FILE__)."/../locales/Forms/UserGroupAffectationProcessMultipleSelectionForm.class.php";

class users_guard_ajaxMultipleAffectationProcessSelectionAction extends mfAction {
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();   
         if (!$this->getUser()->hasCredential(array(array('superadmin','users_groups_multiple_process'))))
            $this->forwardTo401Action ();
        $this->user=$this->getUser();
        $this->form = new UserGroupAffectationProcessMultipleSelectionForm($this->getUser(),$request->getPostParameter('UserGroupSelection'));
        $this->form->bind($request->getPostParameter('UserGroupSelection'));
        try
        {
            if ($this->form->isValid())  
            {
                $multiple=new UserGroupMultipleAffectationProcess($this->form->getCollection(),$this->form->getValues());
                $multiple->process();                        
                $messages->addInfo(__("Groups has been transfered."));
                $this->forward('users_guard','ajaxListPartialGroup');
            }  
            else
            {
                $messages->addError(__("Form has some errors."));
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
     //   return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
