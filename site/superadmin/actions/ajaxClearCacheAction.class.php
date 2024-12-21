<?php

class site_ajaxClearCacheAction extends mfAction {

    function execute(mfWebRequest $request) {
        $messages=mfMessages::getInstance();
        $host=$request->getPostParameter('Host');
        if ($host=="ALL")
        {    
                SiteCacheAdmin::clearCache();
                $messages->addInfo(__("Cache is cleared"));
        }        
        else
        {
            try
            {
                $hostValidator=new mfValidatorDomain();
                $hostValidator->setMessage('required', __("Host is required"));
                $hostValidator->isValid($request->getPostParameter('Host'));
                $site=new Site($request->getPostParameter('Host'));
                if ($site->isLoaded())
                {
                     SiteCacheAdmin::clearCacheSite($site->getHost());
                     $messages->addInfo(__("Cache [%s] is cleared.",$host));
                } 
                else
                   $messages->addError(__("Site [%s] doesn't exist.",$host));
               
            }
            catch (mfException $e)
            {
               $messages->addError($e);
            }
        }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):array("info"=>$messages->getDecodedInfos());      
    }

}

