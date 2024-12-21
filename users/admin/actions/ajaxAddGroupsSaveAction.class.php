<?php

require_once dirname(__FILE__)."/../locales/Forms/AddUserGroupsForm.class.php";

class users_ajaxAddGroupsSaveAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();  
        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_groups_add'))))
            $this->forwardTo401Action();
      try 
      {                   
          $form=new AddUserGroupsForm($this->getUser(),$request->getPostParameter('Groups'),'admin');
          $form->bind($request->getPostParameter('Groups'));
          if ($form->isValid())
          {                                       
               
                $userGroups = new UserGroupCollection($form->getValue('groups'));  
                $userGroups->save();               
                $messages->addInfo(__("Groups added on user [%s].",(string)$form->getUser()));     
                $this->getEventDispather()->notify(new mfEvent($userGroups,'user.group.add',array('user'=>$form->getUser())));
                $request->addRequestParameter('User', $form->getUser());
                $this->forward('users','ajaxGroupsList');                 
          }    
          else
          {
             // var_dump($form->getErrorSchema()->getErrorsMessage());
              $messages->addError(__("Form has some errors."));
      //        $request->addRequestParameter('User', $form->getUser());
       //       $this->forward('users','ajaxGroupsList');   
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }      
       $this->forward('users','ajaxList');  
    }

}