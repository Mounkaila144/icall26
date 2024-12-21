<?php

class customers_meetings_ajaxDeleteIconStatusAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {                
         $item=new CustomerMeetingStatus($request->getPostParameter('CustomerMeetingStatus'));
         if ($item->isLoaded())
         {    
            $item->deleteIcon();           
            $response = array("action"=>"deleteIconStatus",
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

