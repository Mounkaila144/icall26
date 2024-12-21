<?php


class partners_layer_ajaxDeleteLayerAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
      $messages = mfMessages::getInstance();   
      try 
      {                       
          $item= new PartnerLayerCompany($request->getPostParameter('PartnerLayer'));  
          if ($item->isLoaded())
          {    
            $item->delete();              
            $response = array("action"=>"DeleteLayer","id" =>$item->get('id'),"info"=>__("Partner layer has been deleted."));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
