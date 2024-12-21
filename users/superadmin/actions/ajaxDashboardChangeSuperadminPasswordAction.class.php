<?php


require_once __DIR__."/../locales/Forms/DasboardMultipleChangePasswordUserForm.class.php";

class users_ajaxDashboardChangeSuperadminPasswordAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {
           $this->form_sites=new DasboardMultipleChangePasswordUserSitesForm($this->getUser(),$request->getPostParameter('Sites'));
           $this->form_sites->bind($request->getPostParameter('Sites'));
           if ($this->form_sites->isValid())
           {
               $this->form=new DasboardMultipleChangePasswordUserForm($this->getUser(),$request->getPostParameter('Sites'));
              // var_dump($this->form->getSites());
           }   
           else
           {
              // var_dump($this->form->getErrorSchema()->getErrorsMessage());
           }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }     
    }

}

