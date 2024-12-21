<?php


class userGuard_userActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->user=$this->context->getUser(); //->getGuardUser();    
       $this->session=sessionUtils::getUserLastConnexion($this->user->getGuardUser());
       // var_dump($this->context->getUser()->getCredentials());
      // var_dump($this->user->getGuardUser());
     //  var_dump($this->session);
    } 
    
    
}

