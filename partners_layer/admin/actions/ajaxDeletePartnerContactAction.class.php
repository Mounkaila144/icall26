<?php

/*
 * Generated by SuperAdmin Generator date : 24/04/13 15:45:29
 */
 
class partners_layer_ajaxDeletePartnerContactAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {                            
          $item= new PartnerLayerContact($request->getPostParameter('PartnerLayerContact'));           
          if ($item->isLoaded())
          {    
            $item->delete();              
            $response = array("action"=>"DeletePartnerContact",
                              "id" =>$item->get('id'),
                               "info"=>__("Partner contact has been deleted."));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

