<?php


class themes_ajaxDeleteThemeAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance(); 
      $response="";
      try 
      {
           $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
           if (!$site) 
              throw new mfException(__("thanks to select a site"));    
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

