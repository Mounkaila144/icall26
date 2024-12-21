<?php

class site_ajaxClearAutoloadCacheAction extends mfAction {

    function execute(mfWebRequest $request) {
        $messages=mfMessages::getInstance();       
        try
        {                      
             mfContext::getInstance()->getSite()->getSite()->clearAutoload();     
             $messages->addInfo(__("Autoload cache is cleared"));                     
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }       
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):array("info"=>$messages->getDecodedInfos());      
    }

}

