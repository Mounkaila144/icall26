<?php

//require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingCommentViewForm.class.php";



class customers_meetings_comments_ajaxDeleteCommentAction extends mfAction {
    

    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {         
         $item=new CustomerMeetingComment($request->getPostParameter('Comment'));
         if ($item->isLoaded())
         {    
            $item->set('status','DELETE');
            $item->save();
            $response = array("action"=>"DeleteComment",
                              "id" =>$item->get('id')
                          );
         }    
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
