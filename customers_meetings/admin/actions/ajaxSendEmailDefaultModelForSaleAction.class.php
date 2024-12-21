<?php

require_once dirname(__FILE__)."/../locales/Forms/SendEmailDefaultModelForSalesForm.class.php";



class customers_meetings_ajaxSendEmailDefaultModelForSaleAction extends mfAction {
    
                     
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {        
         $form= new SendEmailDefaultModelForSalesForm();
         $form->bind($request->getPostParameter('MeetingSendEmailSales'));
         if ($form->isValid())
         {        
            $sale=$form->getSale();
            if ($sale==null)
                throw new mfException(__("User is meeting owner."));      
            if ($form->getModel()->isNotLoaded())
                throw new mfException(__("Default model doesn't exist."));   
            UserModelEmailUtils::sendEmailForMeeting($form->getMeeting(),$sale,$this->getUser()->getGuardUser(),$form->getModel());
            $response=array('info'=>__("Email has been sent."));
         }    
        // else var_dump($form->getErrorSchema ()->getErrorsMessage());             
      } 
      catch (Exception $e) {
          $messages->addError($e);
      }    
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

    
}
