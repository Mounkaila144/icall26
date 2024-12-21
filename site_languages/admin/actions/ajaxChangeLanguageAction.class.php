<?php

class site_languages_ajaxChangeLanguageAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {
          $language=new mfValidatorInteger();
          $value=new mfValidatorBoolean();
          $language_id=$language->isValid($request->getPostParameter('id'));
          $value=$value->isValid($request->getPostParameter('value'))?"NO":"YES";
          $language= new Language($language_id,'frontend');         
          $language->set('is_active',$value);
          if ($language->isLoaded()) 
          {    
              $language->save();
              $response = array("action"=>"ChangeLanguage","id"=>$language_id,"state" =>$value);
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

