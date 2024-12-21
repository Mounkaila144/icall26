<?php

class  modules_manager_ExportZipModuleAdminAction extends mfAction {
            
    function execute(mfWebRequest $request) {        
        $module=new moduleManagerAdmin($request->getGetParameter('module'));
        if ($module->isLoaded())
        {
          $module->outputZip() ; 
          die();
        }  
        $this->forward404File();        
    }
    
}   
