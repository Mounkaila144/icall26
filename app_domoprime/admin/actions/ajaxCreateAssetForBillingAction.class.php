<?php


class app_domoprime_ajaxCreateAssetForBillingAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                    
      try 
      {   
         $billing=new DomoprimeBilling($request->getPostParameter('Billing'));
        if ($billing->isNotLoaded())
             throw new mfException(__("Billing is invalid."));              
         $asset=new DomoprimeAsset();        
         $asset->createFromBilling($billing,$this->getUser()->getGuardUser());          
          $response = array("action"=>"CreateBillingForContract",                           
                            "info"=>__('Asset has been created.'));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      } 
      catch (Exception $e) {
          $messages->addError($e);
      } 
     return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;        
    }

}
