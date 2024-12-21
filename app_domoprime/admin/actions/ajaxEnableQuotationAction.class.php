<?php


class app_domoprime_ajaxEnableQuotationAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
      $messages = mfMessages::getInstance();   
      try 
      {
                        
          $item= new DomoprimeQuotation($request->getPostParameter('DomoprimeQuotation'));    
          if ($item->isLoaded())
          {    
            $item->enable();              
            $response = array("action"=>"EnableQuotation",
                               "id" =>$item->get('id'),
                              "info"=>__("Quotation has been activated."));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
