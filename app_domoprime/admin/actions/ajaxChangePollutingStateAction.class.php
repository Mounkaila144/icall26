<?php


class app_domoprime_ajaxChangePollutingStateAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
     $messages = mfMessages::getInstance();   
      try 
      {         
        $polluting=new mfValidatorInteger();
        $value=new mfValidatorBoolean(array('empty_value'=>false));                   
        $polluting= new PartnerPolluterCompany($polluting->isValid($request->getPostParameter('id')));         
        if ($polluting->isNotLoaded()) 
             throw new mfException(__("Polluter is invalid."));        
        $polluting->set('is_active',$value->isValid($request->getPostParameter('value'))?"NO":"YES");            
        $polluting->save();   
        $response = array("action"=>"ChangePollutingState","id"=>$polluting->get('id'),"state" =>$polluting->get('is_active'));        
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
        
    

}
