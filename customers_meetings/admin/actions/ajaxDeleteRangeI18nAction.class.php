<?php


 
class customers_meetings_ajaxDeleteRangeI18nAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('CustomerMeetingRangeI18n'));          
          $item= new CustomerMeetingRangeI18n($id);           
          $item->delete();              
          $response = array("action"=>"DeleteRangeI18n","id" =>$id,"info"=>__("Range has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

