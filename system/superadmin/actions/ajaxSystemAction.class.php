<?php

class system_ajaxSystemAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->config=new SystemPhpConfig();     
    }
}
