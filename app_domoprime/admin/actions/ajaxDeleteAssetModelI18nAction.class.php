<?php


class app_domoprime_ajaxDeleteAssetModelI18nAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {                    
          $item= new DomoprimeAssetModelI18n($request->getPostParameter('DomoprimeAssetModelI18n'));           
           $item->delete();              
          $response = array("action"=>"DeleteModelI18n","id" =>$item->get('id'),"info"=>__("Model has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

