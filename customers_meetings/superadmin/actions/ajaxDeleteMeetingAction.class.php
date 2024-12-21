<?php

/*
 * Generated by SuperAdmin Generator date : 07/06/13 10:57:11
 */
 
class customers_meetings_ajaxDeleteMeetingAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {
         $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
         if (!$site)
            return "";
         $item=new CustomerMeeting($request->getPostParameter('Meeting'),$site);
         if ($item->isLoaded())
         {    
            $item->set('status','DELETE');
            $item->save();
            $response = array("action"=>"DeleteMeeting",
                              "id" =>$item->get('id'),                             
                          );
         }    
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

