<?php



class app_domoprime_exportLinkActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        $this->user=$this->getUser();
    } 
    
    
}