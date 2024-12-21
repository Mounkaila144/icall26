<?php

class site_ajaxRemoveRecordSiteAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
      if (!$request->isXmlHttpRequest()) 
         $this->redirect("/superadmin/sites");
      $messages = mfMessages::getInstance();
      try 
      {
         $host=new mfValidatorDomain();
         $host->setMessage('required', __("host is required"));
         if ($host->isValid($request->getPostParameter('Host')))
         {        
            if (mfConfig::getSuperAdmin('host')==$request->getPostParameter('Host'))
                 throw new mfException(__("Delete superadmin host is forbidden."));
            $site=new Site($request->getPostParameter('Host')); 
            if ($site->isNotLoaded())
                throw new mfException(__("Site is invalid."));
            if ($site->isDatabaseExist())
                throw new mfException(__("Database exists."));            
            $site->delete();          
                $response = array("action"=>"RemoveRecordSite",
                                  "host" => $site->get('site_id'),
                                  "info"=>__("Site record [%s] has been deleted",$site->getHost())
                                 );          
         }   
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

