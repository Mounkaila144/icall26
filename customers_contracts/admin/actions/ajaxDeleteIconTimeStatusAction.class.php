<?php


class customers_contracts_ajaxDeleteIconTimeStatusAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {         
         $item=new CustomerContractTimeStatus($request->getPostParameter('CustomerContractTimeStatus'));
         if ($item->isLoaded())
         {    
            $item->deleteIcon();           
            $response = array("action"=>"DeleteIconStatus",
                              "id" =>$item->get('id')
                          );
         }    
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

