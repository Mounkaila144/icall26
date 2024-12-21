<?php


class customers_meetings_ajaxCancelMeetingAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
              throw new mfException(__("thanks to select a site"));    
          $item=new CustomerMeeting($request->getPostParameter('Meeting'),$site);            
          $item->set('is_confirmed','NO');
          $item->save();
          $response = array("action"=>"CancelMeeting","id" =>$item->get('id'),"info"=>__("Meeting is cancelled."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
