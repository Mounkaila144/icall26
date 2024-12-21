<?php

class site_ajaxChangeGlobalAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request)
    {
       $messages=mfMessages::getInstance();
       try 
       {
         $site=new Site($request->getPostParameter('host'));
         if ($site->isLoaded())
         {    
             $value=$request->getPostParameter('value')=='YES'?"NO":"YES";
             $site->set('site_available', $value);
             $site->save();
             $siteSession=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
             if ( $siteSession && $site->isEqual($siteSession))
                  $this->getUser()->getStorage()->write(self::SITE_NAMESPACE, $siteSession->set('site_available',$value));  
             $this->getEventDispather()->notify(new mfEvent($site, 'site.change','change')); 
             $response = array( "action" => "ChangeGlobal", 
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

