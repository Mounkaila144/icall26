<?php
 
class marketing_leads_ajaxTransferToMeetingAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        
        $messages = mfMessages::getInstance();      
        $this->settings = MarketingLeadsWpSettings::load();          
        try
        {
            $this->item=new MarketingLeadsWpForms($request->getPostParameter('WpForms'));     
            if($this->item->isNotLoaded())
                throw new mfException(__('Lead is not loaded.'));        
            if(!$this->settings->hasStatusForMeeting())
                throw new mfException(__('Status for transfert is not defined.'));
            $this->meeting = $this->item->generateMeetingFromLead($this->settings->getStatusForMeeting());
            $this->meeting->save();                        
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->item,'marketing.leads.meeting.transfer.data',$this->meeting));
            $response = array('info'=>__('Meeting has been generated.'));
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}