<?php

require_once dirname(__FILE__)."/../locales/Forms/ConnectedAsUserForm.class.php";

class users_guard_connectedAsUserActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       if (!$this->getUser()->hasCredential(array('users_force_login')))      
           return mfView::NONE;       
       $this->user=$this->getUser(); 
       $this->form=new ConnectedAsUserForm();
       $this->form->bind($request->getPostParameter('ConnectedAsUser'));
       if (!$request->getPostParameter('ConnectedAsUser'))
           return ;
       if ($this->form->isValid())
       {                 
          $user=UserGuardUtils::findByUserIdWithGroupsAndPermissions($this->form->getValue('user_id'));          
          if ($user && $user->isLoaded())
          {    
             $this->getUser()->logout();            
             $this->getUser()->signin($user);  
          }  
         // echo "<pre>"; var_dump($user); echo "</pre>";       
          $this->getContext()->getController()->redirect($request->getReferer());
       }    
       //else var_dump($this->form->getErrorSchema()->getErrorsMessage());
    } 
    
    
}

