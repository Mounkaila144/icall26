<?php


class app_domoprime_ajaxDeletePolluterPricingAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
      $messages = mfMessages::getInstance();   
      try 
      {
           
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('PolluterClassPricing'));          
          $item= new DomoprimePolluterClassPricing($id);           
          $item->delete();              
          $response = array("action"=>"DeletePolluterPricing","id" =>$id,"info"=>__("Pricing has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
