<?php



class system_versions_versionsLinkActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        if (!$this->getUser()->hasCredential(array(array('superadmin','admin','system_versions_display'))))
            return mfView::NONE;        
        $this->system_version = new SystemVersionsFile();
    }
    
}