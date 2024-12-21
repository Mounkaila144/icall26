<?php

class languages_ajaxDeleteLanguageAction extends mfAction {
    
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
          $language=new mfValidatorInteger();
          $language_id=$language->isValid($request->getPostParameter('language'));
          $language= new Language($language_id,array('frontend','admin'),$site);
          $language->delete();          
          $this->getEventDispather()->notify(new mfEvent($language, 'language.change','delete')); 
          $response = array("action"=>"deleteLanguage","id" =>$language_id);
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

