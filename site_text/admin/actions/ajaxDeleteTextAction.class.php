<?php


class site_text_ajaxDeleteTextAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {                    
          $item= new SiteText($request->getPostParameter('SiteText'));           
          $item->delete();              
          $response = array("action"=>"DeleteText","id" =>$item->get('id'),"info"=>__("Text has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

