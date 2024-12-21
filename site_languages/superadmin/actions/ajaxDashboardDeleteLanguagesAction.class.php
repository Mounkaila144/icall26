<?php

class languages_ajaxDashboardDeleteLanguagesAction extends mfAction {
    
    
    function execute(mfWebRequest $request) { 
      if (!$request->isXmlHttpRequest()) 
            $this->redirect("/superadmin/languages");
      $messages = mfMessages::getInstance();
      try 
      {
          $languagesValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $languagesValidator->isValid($request->getPostParameter('selection'));
          $languagesCollection= new LanguageCollection($request->getPostParameter('selection'));
          $languagesCollection->delete();     
          $this->getEventDispather()->notify(new mfEvent($languagesCollection, 'languages.change','delete')); 
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

