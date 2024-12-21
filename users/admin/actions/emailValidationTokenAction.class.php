<?php

class users_emailValidationTokenAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
        $this->parametersToVariables();        
    //   echo "<pre>"; var_dump($this->token->getCallback());
    }

}

