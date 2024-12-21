<?php

require_once dirname(__FILE__)."/../locales/Forms/UserGroupProcessMultipleSelectionForm.class.php";

class users_guard_ajaxMultipleProcessSelectionAction extends mfAction {
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                        
        $this->user=$this->getUser();
         if (!$this->getUser()->hasCredential(array(array('superadmin','users_groups_multiple_process'))))
            $this->forwardTo401Action ();
       // var_dump($request->getPostParameter('UserGroupSelection'));
        $this->form = new UserGroupProcessMultipleSelectionForm($this->getUser(),$request->getPostParameter('UserGroupSelection'));
        $this->form->bind($request->getPostParameter('UserGroupSelection'));
        try
        {
            if ($this->form->isValid())  
            {
                $multiple=new UserGroupMultipleProcess($this->form->getCollection(),$this->form->getActionValues(),$this->form->getValues());
                $multiple->process();                        
                $messages->addInfo(__("Groups has been updated."));
             //   $this->forward('users_guard','ajaxListPartialGroup');
            }  
            else
            {
                $messages->addError(__("Form has some errors."));
              //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
     //   return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
