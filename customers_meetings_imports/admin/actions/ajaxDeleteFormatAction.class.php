<?php

/*
 * Generated by SuperAdmin Generator date : 07/06/13 10:57:11
 */
 
class customers_meetings_imports_ajaxDeleteFormatAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {        
         $item=new CustomerMeetingImportFormat($request->getPostParameter('CustomerMeetingFormat'));        
         if ($item->isLoaded())
         {    
            $item->delete();
            $response = array("action"=>"DeleteFormat",
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

