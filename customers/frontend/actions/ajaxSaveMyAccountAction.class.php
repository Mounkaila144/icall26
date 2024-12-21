<?php


require_once dirname(__FILE__)."/../locales/Forms/MyAccountForm.class.php";


class customers_ajaxSaveMyAccountAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->user=$this->getUser()->getGuardUser();       
        $this->form= new MyAccountForm($request->getPostParameter('MyAccount'));                        
        if (!$request->isMethod('POST') || !$request->getPostParameter('MyAccount'))
            return ;
        $this->form->bind($request->getPostParameter('MyAccount'));
        if ($this->form->isValid())
        {
             $this->user->add($this->form->getValues());             
             $this->user->encryptPassword();
             $this->user->save();
             $messages->addInfo(__('Your account has been updated.'));                         
        }   
        else
        {
            //echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>"; 
             $messages->addError(__('Form has some errors.'));  
            $this->user->add($request->getPostParameter('MyAccount'));
        }    
    }
}