<?php

class customers_contracts_ajaxDeleteHeaderCompanyAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance(); 
      $current_user=$this->getUser()->getGuardUser(); // get current user 
      try 
      {                  
          $company=new mfValidatorInteger();
          $company_id=$company->isValid($request->getPostParameter('CustomerContractCompany'));
          $company= new CustomerContractCompany($company_id);
          if ($company->get('header') && $company->isLoaded())
          {    
            $company->deleteHeader();
            $response = array("action"=>"DeleteHeader","id" =>$company->get('id'));
          }  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
