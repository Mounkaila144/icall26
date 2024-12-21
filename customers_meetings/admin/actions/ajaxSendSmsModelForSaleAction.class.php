<?php

require_once dirname(__FILE__)."/../locales/Forms/SendSmsModelForSalesForm.class.php";



class customers_meetings_ajaxSendSmsModelForSaleAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {        
         $form= new SendSmsModelForSalesForm();
         $form->bind($request->getPostParameter('MeetingSendSmsSales'));
         if ($form->isValid())
         {        
            $sale=$form->getSale();
            if ($sale==null)
                throw new mfException(__("User is meeting owner."));
            try
            {
              $content=$this->getComponent('/customers_meetings/smsForSale', array('COMMENT'=>false,'meeting'=>$form->getMeeting(),'user'=>$sale,'model_i18n'=>$form->getModelI18n()))->getContent();                      
            }
            catch (SmartyCompilerException $e)
            {
                trigger_error($e->getMessage());
                throw new mfException(__("Error Syntax in model."));              
            }
            UserModelSmsUtils::sendSms($sale,$this->getUser()->getGuardUser(),$form->getModelI18n()->getModel(),$content);
            $response=array('info'=>__("Sms has been sent."));
         }    
       //  else var_dump($form->getErrorSchema ()->getErrorsMessage());             
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->getController()->setRenderMode(mfView::RENDER_JSON);    
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

    
}
