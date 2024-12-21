<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingSalesForm.class.php";



class customers_meetings_ajaxChangeSaleAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {        
          $form=new CustomerMeetingSalesForm($this->getUser());
          $form->bind($request->getPostParameter('MeetingSales'));
          if ($form->isValid())
          {   
              $meeting=$form->getMeeting();              
              $meeting->set($form->getSaleField(),$form['sale_id']->getValue());             
              $meeting->setComments($this->getUser());   
              $meeting->save();
              $response=array('id'=>$meeting->get('id'),
                           //   'info'=>$form->isSale1()?__("Commercial 1 has been changed."):__("Commercial 2 has been changed."),                              
                            );                              
          }  
         // else var_dump($form->getErrorSchema ()->getErrorsMessage());
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
