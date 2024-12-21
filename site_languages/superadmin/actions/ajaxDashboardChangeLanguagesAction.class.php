<?php

class languages_ajaxDashboardChangeLanguagesAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
          $form=new changeLanguagesForm($request->getPostParameter('languages'));
          $form->bind($request->getPostParameter('languages'));
          if ($form->isValid())
          {    
            $languages= new LanguageCollection($form->getValue('languages'));   
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

