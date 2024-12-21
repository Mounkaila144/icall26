<?php

class users_emailSigninAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
       $this->user=$this->parameters;
    }

}
