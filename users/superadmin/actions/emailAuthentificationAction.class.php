<?php

class users_emailAuthentificationAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
      //  $this->parametersToVariables();        
       $this->user=$this->getUser()->getGuardUser();
       $this->ip=$request->getIp();
       $this->host=$request->getHost();
    }

}

