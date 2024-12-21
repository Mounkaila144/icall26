<?php

class site_ajaxSiteClearCacheFrontendAction extends mfAction {

    const SITE_NAMESPACE = 'system/site';   
         
    function execute(mfWebRequest $request) {
      $messages=mfMessages::getInstance();              
      try 
      {
         $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
         if (!$site)
            return "";
         $site->clearFrontendCache();         
         $response = array("info"=>__("Cache frontend is cleared."));         
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

