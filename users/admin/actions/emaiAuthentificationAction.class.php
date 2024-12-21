<?php

class users_emailAuthentificationAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
      //  $this->parametersToVariables();        
       $this->user=$this->getUser()->getGuardUser();
    }

}

