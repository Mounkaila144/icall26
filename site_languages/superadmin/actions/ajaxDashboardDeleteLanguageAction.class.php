<?php

class languages_ajaxDashboardDeleteLanguageAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
//      if (!$request->isXmlHttpRequest()) 
//            $this->redirect("/superadmin/languages");
      $messages = mfMessages::getInstance();   
      try 
      {
          $language=new mfValidatorInteger();
          $language_id=$language->isValid($request->getPostParameter('language'));
          $language= new Language($language_id);
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

