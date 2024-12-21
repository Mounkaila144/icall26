<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractPartnerForm.class.php";



class customers_contracts_ajaxChangePartnerAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {        
          $form=new CustomerContractPartnerForm($this->getUser());
          $form->bind($request->getPostParameter('ContractPartner'));
          if ($form->isValid())
          {  
              $contract=$form->getContract();              
              $contract->set('financial_partner_id',$form->getPartner());             
              $contract->setComments($this->getUser());  
              $contract->save();
              $response=array('action'=>'ChangePartner',
                              'id'=>$contract->get('id'),
                              'info'=>__("Partner has been changed."),                              
                            );                              
          }  
         else{
            // var_dump($form->getErrorSchema()->getErrorsMessage());
             $response=array('action'=>'ChangePartner',
                             'errors'=>$form->getErrorSchema()->getErrorsMessage()                          
                            ); 
         }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
