<?php


class site_services_ServiceChangeAdminAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
     $messages=mfMessages::getInstance();
      try 
      {
         $site=new Site($request->getPostParameter('host'));

         if ($site->isLoaded())
         {     
             $value=$request->getPostParameter('value')=='YES'?"NO":"YES";
             $site->set('site_admin_available', $value);
             $site->save();            
             $this->getEventDispather()->notify(new mfEvent($site, 'site.change','change')); 
             $response = array( "action" => "ChangeAdmin", 
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
