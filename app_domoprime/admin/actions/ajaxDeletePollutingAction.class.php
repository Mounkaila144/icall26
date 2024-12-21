<?php


class app_domoprime_ajaxDeletePollutingAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
      $messages = mfMessages::getInstance();   
      try 
      {
           
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('Polluting'));          
          $item= new DomoprimePollutingCompany($id);           
          $item->disable();              
          $response = array("action"=>"DeletePolluting","id" =>$id,"info"=>__("Polluting has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
