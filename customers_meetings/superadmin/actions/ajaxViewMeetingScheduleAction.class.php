<?php


class customers_meetings_ajaxViewMeetingScheduleAction extends mfAction {

const SITE_NAMESPACE = 'system/site';
    

        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();               
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);                                           
        try
        {
             $this->meeting=new CustomerMeeting($request->getPostParameter('id'),$this->site);                         
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
   
    }
    
}    