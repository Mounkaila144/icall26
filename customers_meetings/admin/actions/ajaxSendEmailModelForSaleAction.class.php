<?php

require_once dirname(__FILE__)."/../locales/Forms/SendEmailModelForSalesForm.class.php";



class customers_meetings_ajaxSendEmailModelForSaleAction extends mfAction {
    
                     
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {        
         $form= new SendEmailModelForSalesForm();
         $form->bind($request->getPostParameter('MeetingSendEmailSales'));
         if ($form->isValid())
         {        
            $sale=$form->getSale();
            if ($sale==null)
                throw new mfException(__("User is meeting owner."));            
            UserModelEmailUtils::sendEmailForMeeting($form->getMeeting(),$sale,$this->getUser()->getGuardUser(),$form->getModelI18n()->getModel());
            $response=array('info'=>__("Email has been sent."));
         }    
      //   else var_dump($form->getErrorSchema ()->getErrorsMessage());             
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }    
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

    
}
