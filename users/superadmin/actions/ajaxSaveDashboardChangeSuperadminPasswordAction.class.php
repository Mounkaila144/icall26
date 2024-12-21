<?php


require_once __DIR__."/../locales/Forms/DasboardMultipleChangePasswordUserForm.class.php";

class users_ajaxSaveDashboardChangeSuperadminPasswordAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {
           $this->form=new DasboardMultipleChangePasswordUserForm($this->getUser(),$request->getPostParameter('SitesUser'));
           $this->form->bind($request->getPostParameter('SitesUser'));
           if ($this->form->isValid())
           {
              // var_dump($this->form->getSites());
               $errors=UserUtils::changePasswordForUserForSites($this->form->getSites(), $this->form->getValue('login'),$this->form->getValue('password'));
               if ($errors->isEmpty())
               {    
                   $messages->addInfo(__("Password for users have been modified."));
                   $this->forward('site', 'ajaxListPartial');
               }
               else
               {
                   $messages->addError(__("Password for users have not been modified on sites [%s].",$errors->implode()));
               }    
           }   
           else
           {
              // var_dump($this->form->getErrorSchema()->getErrorsMessage());
                $messages->addError(__("Form has some errors."));
           }    
           
           
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }         
      
   //   var_dump($this->form->getSelection());
    }

}

