<?php


class site_ajaxListAction extends mfAction {
    
   
     
    function execute(mfWebRequest $request)
    {        
         $messages = mfMessages::getInstance();                 
         $this->master=$request->getSite();
    }
	
}

