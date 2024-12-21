<?php

class site_ajaxChangeAccessAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
      $messages=mfMessages::getInstance();
      try {
            $form = new siteChangeAccessForm();
            $form->bind($request->getPostParameter('site'));
            if ($form->isValid()) 
            {
                $site=new Site($form['host']);
                if ($site->isLoaded())
                { 
                        $value=$form->getValue('access_restricted')?0:1;
                        $site->set("site_access_restricted",$value);
                        $site->save();
                        $siteSession=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
                        if ( $siteSession && $site->isEqual($siteSession))
                             $this->getUser()->getStorage()->write(self::SITE_NAMESPACE, $siteSession->set('site_access_restricted',$value));  
                        $this->getEventDispather()->notify(new mfEvent($site, 'site.change','change.access'));
                        $response = array( "action"=>"ChangeAccess","host" => $site->getHost(),"state" =>$value);
                }
            }            
        } 
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

