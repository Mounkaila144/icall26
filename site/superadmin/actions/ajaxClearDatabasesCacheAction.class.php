<?php

class site_ajaxClearDatabasesCacheAction extends mfAction {

    function execute(mfWebRequest $request) {
        $messages=mfMessages::getInstance();       
        try
        {                      
             mfContext::getInstance()->getSite()->getSite()->clearDatabases();  
             $messages->addInfo(__("Databases cache is cleared"));                     
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }       
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):array("info"=>$messages->getDecodedInfos());      
    }

}

