<?php


class site_services_ServiceChangeFrontendAction extends mfAction {
    
     
    function execute(mfWebRequest $request)
    {
      $messages=mfMessages::getInstance();
      try 
      {
         $site=new Site($request->getPostParameter('host'));
         if ($site->isLoaded())
         {    
             $value=$request->getPostParameter('value')=='YES'?"NO":"YES";
             $site->set('site_frontend_available', $value);
             $site->save();            
             $this->getEventDispather()->notify(new mfEvent($site, 'site.change','change')); 
             $response = array( "action" => "ChangeFrontend", 
                                "state" => $value, 
                                "host" => $site->getHost());
         } 
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}