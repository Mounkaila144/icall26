<?php

class site_ajaxSiteClearCacheAction extends mfAction {

    const SITE_NAMESPACE = 'system/site';   
     
    function execute(mfWebRequest $request) {
      $messages=mfMessages::getInstance(); 
       try 
      {
         $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
         if (!$site)
            return "";
         $site->clearCache();
         $site->removeHostCache();
         $response = array("info"=>__("Cache is cleared."));   
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response; 
    }

}

