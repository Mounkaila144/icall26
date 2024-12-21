<?php

class site_languages_ajaxChangeLanguageAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {   
      if (!$request->isXmlHttpRequest()) 
            $this->redirect("/superadmin/languages");
      $messages = mfMessages::getInstance();   
      try 
      {
          $language=new mfValidatorInteger();
          $value=new mfValidatorBoolean();
          $language_id=$language->isValid($request->getPostParameter('id'));
          $value=$value->isValid($request->getPostParameter('value'))?"NO":"YES";
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);     
          $language= new Language($language_id,array('frontend','admin'),$site);         
          $language->set('is_active',$value);
          if ($language->isLoaded()) 
          {    
              $language->save();
              $this->getEventDispather()->notify(new mfEvent($language, 'language.change','change.active')); 
              $response = array("action"=>"ChangeLanguage","id"=>$language_id,"state" =>$value);
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

