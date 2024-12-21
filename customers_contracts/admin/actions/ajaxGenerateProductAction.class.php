<?php

/*
 * Generated by SuperAdmin Generator date : 07/06/13 10:57:11
 */
 
class customers_contracts_ajaxGenerateProductAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {        
         $item=new CustomerContract($request->getPostParameter('Contract'));
         if ($item->isLoaded())
         {    
            $item->productsToContract();           
            $response = array("info"=>__("Products transferred."),
                              
                          );
         }    
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
