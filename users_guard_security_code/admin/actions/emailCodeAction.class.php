<?php

class users_guard_security_code_emailCodeAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {    
       // Affected local data
       $this->parametersToVariables() ;      
       $this->ip = $request->getIP();
       $this->host= $request->getHost();
       $this->user=$request->getRequestParameter('user');
    }

}
