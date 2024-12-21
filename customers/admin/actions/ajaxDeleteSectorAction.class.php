<?php

 
class customers_ajaxDeleteSectorAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('CustomerSector'));          
          $item= new CustomerSector($id);           
          $item->delete();              
          $response = array("action"=>"DeleteSector","id" =>$id,"info"=>__("Sector [%s] has been deleted.",$item->get('meta_title')));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

