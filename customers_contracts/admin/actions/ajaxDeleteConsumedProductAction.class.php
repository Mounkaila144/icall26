<?php


 
class customers_contracts_ajaxDeleteConsumedProductAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {        
         $item=new CustomerContractProduct($request->getPostParameter('ContractProduct'));
         if ($item->isLoaded())
         {    
            $item->set('is_consumed','NO')->save();           
            $response = array("action"=>"DeleteConsumedProduct",
                              "info"=>__('Product is consomable.'),
                              "is_consumed"=>__($item->get('is_consumed')),
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

