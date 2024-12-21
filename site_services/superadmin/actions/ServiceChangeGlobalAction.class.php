<?php


class site_services_ServiceChangeGlobalAction extends mfAction{
    
   
    function execute(mfWebRequest $request)
    {
       $messages=mfMessages::getInstance();
       try 
       {
         $site=new Site($request->getPostParameter('host'));
         if ($site->isNotLoaded())
            throw new mfException('Host is invalid.') ;
        $value=$request->getPostParameter('value')=='YES'?"NO":"YES";
        $site->set('site_available', $value);
        $site->save();             
        $this->getEventDispather()->notify(new mfEvent($site, 'site.change','change')); 
        $response = array( "action" => "ChangeGlobal", 
                           "state" => $value, 
                           "host" => $site->getHost());        
       } 
       catch (mfException $e) {
            $messages->addError($e);
       }
       return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
    
}
