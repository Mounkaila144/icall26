<?php

require_once __DIR__."/../locales/Exports/GroupExport.class.php";

class users_guard_ExportGroupAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();                       
        try
        {
            $group=new Group($request->getGetParameter('Group'),'admin');
            if ($group->isNotLoaded())
                throw new mfException(__('Group is invalid.'));
            $csv=new GroupExport($group);
            $csv->execute();
            
             ob_start();
          ob_end_clean();
          $response=$this->getResponse();
          $response->setHeaderFile($csv->getFilename(),true);
          $response->sendHttpHeaders();
          readfile($csv->getFilename()); 
          
          $this->getEventDispather()->notify(new mfEvent($csv,'user.guard.groups.export'));
          die();
            
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
        die();
    }

}
