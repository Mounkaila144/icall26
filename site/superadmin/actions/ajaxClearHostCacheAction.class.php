<?php

class site_ajaxClearHostCacheAction extends mfAction {

    function execute(mfWebRequest $request) {
        $messages=mfMessages::getInstance();       
        try
        {                      
                 SiteCacheAdmin::clearHostCache();
                 $messages->addInfo(__("Host cache is cleared"));                     
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }       
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):array("info"=>$messages->getDecodedInfos());      
    }

}

