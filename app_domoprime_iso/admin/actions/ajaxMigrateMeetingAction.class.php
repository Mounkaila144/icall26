<?php
/*
 SELECT t_customers_contract.id,t_services_impot_verif_request.reference,t_services_impot_verif_request.number FROM `t_services_impot_verif_request` 
 INNER JOIN t_services_impot_verif_customer ON t_services_impot_verif_customer.request_id = t_services_impot_verif_request.id
 INNER JOIN t_customers_contract ON t_customers_contract.customer_id=t_services_impot_verif_customer.customer_id
 WHERE t_customers_contract.id=''
 */

class app_domoprime_iso_ajaxMigrateMeetingAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
           
          $meeting=new CustomerMeeting($request->getPostParameter('Meeting'));
          if ($meeting->isNotLoaded())
              throw new mfException(__('Meeting is invalid.'));
          DomoprimeCustomerMeetingForms::initializeSettings();
          $forms=new DomoprimeCustomerMeetingForms($meeting);
          $forms->transfertToRequest()->save();
          
          DomoprimeCustomerRequest::setContractFromMeeting();
          
          $response = array("action"=>"MigrateMeeting",
                            "info"=>__("Migration has been done."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

