<?php


class customers_contracts_ajaxDeleteIconInstallStatusAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {         
         $item=new CustomerContractInstallStatus($request->getPostParameter('CustomerContractInstallStatus'));
         if ($item->isLoaded())
         {    
            $item->deleteIcon();           
            $response = array("action"=>"deleteIconStatus",
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

