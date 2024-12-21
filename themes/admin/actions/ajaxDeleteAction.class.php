<?php


class themes_ajaxDeleteAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance(); 
      $response="";
      try 
      {
          $theme= new ThemeFrontend($request->getPostParameter('Theme'));
          if (!$theme->isLoaded())
              throw new mfException(__("Theme doesn't exist."));
          $theme->delete();
          $response = array("action"=>"deleteTheme","id" =>$theme->get('id'));  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

