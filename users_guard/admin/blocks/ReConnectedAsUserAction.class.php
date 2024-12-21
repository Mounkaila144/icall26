<?php



class users_guard_ReConnectedAsUserActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
       if (!$this->getUser()->hasCredential(array(array('users_force_relogin'))))      
           return mfView::NONE;                     
       if (!$request->getPostParameter('ReloginUser'))
           return ;
       if ($request->getPostParameter('ReloginUser')=='YES')
       {                       
          $user=UserGuardUtils::findByUserIdWithGroupsAndPermissions($this->getUser()->getGuardUser()->get('id'));           
          if ($user && $user->isLoaded())
          {                  
             $this->getUser()->logout();            
             $this->getUser()->signin($user);  
             $this->getContext()->getController()->redirect($request->getReferer());
          }  
         // echo "<pre>"; var_dump($user); echo "</pre>";                 
       }   
    } 
    
    
}

