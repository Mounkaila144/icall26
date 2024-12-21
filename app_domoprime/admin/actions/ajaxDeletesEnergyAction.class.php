<?php

/*
 * Generated by SuperAdmin Generator date : 24/04/13 15:45:29
 */
 
class app_domoprime_ajaxDeletesEnergyAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $validator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $validator->isValid($request->getPostParameter('selection'));
          $statuses= new DomoprimeEnergyCollection($request->getPostParameter('selection'));
          $statuses->delete();                              
          $response = array("action"=>"DeletesEnergy","info"=>__("Status has been deleted."),"parameters" =>$request->getPostParameter('selection'));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

