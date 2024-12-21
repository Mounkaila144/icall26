<?php


class app_domoprime_ajaxRefreshQuotationAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
      $messages = mfMessages::getInstance();   
      try 
      {
                        
          $item= new DomoprimeQuotation($request->getPostParameter('DomoprimeQuotation'));    
          if ($item->isLoaded())
          {    
            $item->set('reference',$item->getFormattedReference())->save();              
            $response = array("action"=>"RefreshQuotation",
                               "id" =>$item->get('id'),
                               "reference" =>$item->get('reference'),
                              "info"=>__("Reference has been Loadded."));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }



}
