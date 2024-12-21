<?php

 
class users_ajaxDeleteCallcenterAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('Callcenter'));          
          $item= new Callcenter($id);           
          $item->delete();              
          $response = array("action"=>"DeleteCallcenter","id" =>$id,"info"=>__("Callcenter [%s] has been deleted.",$item->get('meta_title')));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

