<?php



class app_domoprime_iso_linkConfigurationActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                        
        $this->user=$this->getUser();
        if (!$this->getUser()->hasCredential(array(array('superadmin'))))
            return mfView::NONE;
    } 
    
    
}