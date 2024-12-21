<?php

class site_ajaxCleanUpForProductionAction extends mfAction {

    const SITE_NAMESPACE = 'system/site';   
     
    function execute(mfWebRequest $request) {
      $messages=mfMessages::getInstance(); 
      try 
      {
         $site = $this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
         if (!$site) 
                throw new mfException(__("no site selected."));
         $this->getEventDispather()->notify(new mfEvent($site, 'site.cleanup')); 
         $response = array("info"=>__("site is prepared for production."));   
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response; 
    }

}

