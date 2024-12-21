<?php

class customers_contracts_ajaxDeletePictureCompanyAction extends mfAction {
    

    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();     
      try 
      {          
          $company=new mfValidatorInteger();
          $company_id=$company->isValid($request->getPostParameter('CustomerContractCompany'));
          $company= new CustomerContractCompany($company_id);
          if ($company->get('picture') && $company->isLoaded())
          {    
            $company->deletePicture();
            $response = array("action"=>"DeletePicture","id" =>$company->get('id'));
          }  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
