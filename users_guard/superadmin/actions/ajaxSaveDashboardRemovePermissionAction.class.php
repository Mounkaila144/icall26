<?php


require_once __DIR__."/../locales/Forms/DasboardMultipleRemovePermissionForm.class.php";

class users_guard_ajaxSaveDashboardRemovePermissionAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {
           $this->form=new DasboardMultipleRemovePermissionForm($this->getUser(),$request->getPostParameter('SitesPermission'));
           $this->form->bind($request->getPostParameter('SitesPermission'));
           if ($this->form->isValid())
           {
              // var_dump($this->form->getSites());
               PermissionUtils::removePermissionsForSites($this->form->getSites(), $this->form->getPermissions());
               $messages->addInfo(__("Permissions have been removed."));
             //  $this->forward('site', 'ajaxListPartial');
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

