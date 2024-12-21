<?php

class site_ajaxHomeAction extends mfAction {
    
  //  const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
       $messages=mfMessages::getInstance(); 
           $this->user=$this->context->getUser();   
       
    }

}

