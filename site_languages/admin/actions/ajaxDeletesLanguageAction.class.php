<?php

class site_languages_ajaxDeletesLanguageAction extends mfAction {
       
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {  
          $languagesValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $languagesValidator->isValid($request->getPostParameter('selection'));
          $languages= new LanguageCollection($request->getPostParameter('selection'),'frontend');
          $languages->delete();          
          $response = array("action"=>"deleteLanguages","parameters" =>$request->getPostParameter('selection'));
      } 
      catch (mfValidatorErrorSchema $e)
      {
          $messages->addErrors(array_merge($e->getGlobalErrors(),$e->getErrors()));
      }
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

