<?php

class sites_ajaxChangeFrontendSitesAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
          $form=new SitesChangeForm($request->getPostParameter('sites'),'frontend'); 
          $form->bind($request->getPostParameter('sites'));
          if ($form->isValid())
          {
              $sites= new SiteCollectionByHost($form->getValue('sites')); 
              $sites->save();  
              $response = array("action"=>"ChangeFrontend",
                                "state" =>$form->getValue('value'),
                                "selection" =>$form->getValue("selection")
                               ); 
          }    
          else
          {
              $messages->addErrors(array_merge($form->getErrorSchema()->getGlobalErrors(),$form->getErrorSchema()->getErrors()));
          }      
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
