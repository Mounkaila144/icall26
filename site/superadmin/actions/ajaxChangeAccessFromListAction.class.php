<?php

class site_ajaxChangeAccessFromListAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
      $messages=mfMessages::getInstance();
      try {
            $form = new ChangeForm();
            $form->bind($request->getPostParameter('SiteAccess'));
            if ($form->isValid()) 
            {
                $site=new Site($form['id']->getValue());
                if ($site->isLoaded())
                {                                                
                        $site->set("site_access_restricted",($form->getValue('value')=='YES'?0:1));
                        $site->save();
                        $siteSession=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
                        if ( $siteSession && $site->isEqual($siteSession))
                             $this->getUser()->getStorage()->write(self::SITE_NAMESPACE, $site);  
                        $this->getEventDispather()->notify(new mfEvent($site, 'site.change','change.access'));
                        $response = array( "action"=>"ChangeAccess","id" => $site->get('site_id'),"state" =>$site->getAccessable());
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

