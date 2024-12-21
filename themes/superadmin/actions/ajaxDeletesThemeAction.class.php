<?php

class themes_ajaxDeletesThemesAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
          $themesValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $themesValidator->isValid($request->getPostParameter('selection'));
          $themes= new ThemesCollection($request->getPostParameter('selection'),'admin',$site);
          $themes->delete();          
          $response = array("action"=>"deleteThemes","parameters" =>$request->getPostParameter('selection'));
      } 
      catch (mfValidatorErrorSchema $e)
      {
          $messages->addErrors(array_merge($e->getGlobalErrors(),$e->getErrors()));
      }
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

