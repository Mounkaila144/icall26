<?php


class app_domoprime_ajaxDisableQuotationAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
      $messages = mfMessages::getInstance();   
      try 
      {
                        
          $item= new DomoprimeQuotation($request->getPostParameter('DomoprimeQuotation'));    
          if ($item->isLoaded())
          {    
            $item->disable();              
            $response = array("action"=>"DisableQuotation",
                               "id" =>$item->get('id'),
                              "info"=>__("Quotation has been deleted."));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
