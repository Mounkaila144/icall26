<?php

require_once __DIR__."/../locales/Forms/MutualProductsForMeeting/NewMutualProductForMeetingForm.class.php";

class app_mutual_ajaxSaveNewProductForMeetingAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser();
        $this->meeting = new CustomerMeeting($request->getPostParameter("Meeting"));
        if ($this->meeting->isNotLoaded())
        {
            $this->getController()->setRenderMode(mfView::RENDER_JSON);
            return array("error"=>__('Meeting not loaded'));
        }
        $this->key=$request->getPostParameter('key');
        $this->meeting_products=new CustomerMeetingMutualProductCollection();   
        $this->form=new NewMutualProductForMeetingForm($this->meeting,$request->getPostParameter('CustomerMeetingMutualProduct'));                 
        if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerMeetingMutualProduct'))
        {
            $this->getController()->setRenderMode(mfView::RENDER_JSON);
            return array("error"=>__('No parameters'));
        }
        $this->form->bind($request->getPostParameter('CustomerMeetingMutualProduct'));
        if ($this->form->isValid())
        {
            $this->meeting_products = CustomerMeetingMutualProduct::updateMeetingMutualProducts($this->meeting, $this->form);
            $messages->addInfo(__('Products has been saved.'));
        }   
        else
        {        
            $this->meeting_products = $this->form->getDefaultsAsCollection();
            $messages->addError(__('Form has some errors.'));
        }    
    }
    
}

