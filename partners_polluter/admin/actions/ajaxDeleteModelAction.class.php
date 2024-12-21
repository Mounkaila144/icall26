<?php


class partners_polluter_ajaxDeleteModelAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
      $messages = mfMessages::getInstance();   
      try 
      {
           
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('Model'));          
          $item= new PartnerPolluterModel($id);           
          $item->delete();              
          $response = array("action"=>"DeleteModel","id" =>$id,"info"=>__("Model has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
