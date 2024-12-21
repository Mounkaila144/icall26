<?php


class customers_meetings_ajaxConfirmMeetingAction extends mfAction {
    
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
          $item->set('is_confirmed','YES');
          $item->setComments($this->getUser());
          $item->save();
          $response = array("action"=>"ConfirmMeeting","id" =>$item->get('id'),"info"=>__("Meeting is confirmed."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
