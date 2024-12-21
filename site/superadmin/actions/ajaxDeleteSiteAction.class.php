<?php

class site_ajaxDeleteSiteAction extends mfAction {
    
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
                 throw new mfException(__("delete superadmin host is forbidden."));
            $site=new Site($request->getPostParameter('Host')); 
            if ($site->isLoaded())
            {                  
                SiteUtils::deleteSite($site); // On supprime database + rep
                $site->delete(); // Mandatory after delete site               
                $response = array("action"=>"deleteSite",
                                  "host" => $site->get('site_id'),
                                  "info"=>__("Site [%s] has been deleted",$site->getHost())
                                 );
            }
            else
              $messages->addError(__("site [%s] doesn't exist",$request->getPostParameter('Host')));
         }   
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

