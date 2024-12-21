<?php

class app_mutual_ajaxUpdateProductForViewMeetingAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();
        $this->key=$request->getPostParameter('key');
        $this->meeting=new CustomerMeetingMutual($request->getPostParameter('Meeting'));   
        $this->meeting_product=new CustomerMeetingMutualProduct($request->getPostParameter('CustomerMeetingMutualProduct'));   
        $this->user=$this->getUser();
        if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerMeetingMutualProduct'))
        {
            $this->getController()->setRenderMode(mfView::RENDER_JSON);
            return array("action"=>"UpdateProductForViewMeeting","error"=>__("Parameters needed"));
        }
        
        if (!$this->meeting->isLoaded() || !$this->meeting_product->isLoaded())
        {
            $this->getController()->setRenderMode(mfView::RENDER_JSON);
            return array("action"=>"UpdateProductForViewMeeting","error"=>__('Meeting or product is not loaded'));
        }    
    }
    
}

