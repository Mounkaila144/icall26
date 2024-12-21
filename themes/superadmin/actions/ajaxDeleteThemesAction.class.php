<?php


class themes_ajaxDeleteThemesAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance(); 
      $response="";
      try 
      {
          $theme= new Themes($request->getPostParameter('theme'));
          if ($theme->isNotLoaded())
              throw new mfException(__("theme doesn't exist."));
          $theme->delete();
          $response = array("action"=>"deleteThemes","id" =>$theme->get('id'));  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

