<?php

class languages_ajaxDeleteLanguagesAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) { 
      if (!$request->isXmlHttpRequest()) 
            $this->redirect("/superadmin/languages");
      $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
      if (!$site)
          return ;
      $messages = mfMessages::getInstance();
      try 
      {  //@TODO check la liste des languages authorized
          $languagesValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $languagesValidator->isValid($request->getPostParameter('selection'));
          $languages= new LanguageCollection($request->getPostParameter('selection'),array('frontend','admin'),$site);
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

