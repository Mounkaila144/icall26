<?php

class languages_ajaxChangeLanguagesAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) { 
      if (!$request->isXmlHttpRequest()) 
            $this->redirect("/superadmin/languages");
      $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
      if (!$site)
          return ;
      $messages = mfMessages::getInstance();
      try
      {
          $form=new changeLanguagesForm($request->getPostParameter('languages'));
          $form->bind($request->getPostParameter('languages'));
          if ($form->isValid())
          {    
            $languages= new LanguageCollection($form->getValue('languages'),array('admin','frontend'),$site);   
            $languages->save();
            $this->getEventDispather()->notify(new mfEvent($languages, 'languages.change','change')); 
            $response = array("action"=>"ChangeLanguages",
                            "state" =>$form->getValue('value'),
                            "selection" =>$form->getValue('selection')
                           );
          }
      }
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

