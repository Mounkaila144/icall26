<?php

// www.ecosol16.net/admin/api/v2/meetings/admin/UpdateMeeting

require_once __DIR__."/../locales/Forms/CustomerMeetingViewForm.class.php";

class CustomerMeetingUpdateMeetingApi2Form extends CustomerMeetingViewForm {
    
    function __construct($user,$defaults=array()) {
        $this->user=$user;
        $this->data=new mfArray();
        $this->settings=new CustomerMeetingSettings();     
        $this->warnings=new mfArray();
        parent::__construct($user,new CustomerMeeting($defaults['id']),$defaults);
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);           
        return parent::configure();
    }
     
    function getWarnings()
    {
        return $this->warnings;
    }
    
    function isValid()
    {
        if (parent::isValid())
        {          
            if ($this->is_processed)
                return true;
            $this->is_processed=true;
            $this->getMeeting()->add($this['meeting']->getValues());  
            // Comment  
            $this->getMeeting()->setComments($this->getUser());  
            if (!$this->meeting->hasValidator('assistant_id'))
                 $this->getMeeting()->updateAssistant($this->getUser());                        
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getMeeting(), 'meeting.update',array('form'=>$this,'action'=>'update')));                                      
            $this->getMeeting()->save();                   
            // Customer
            $this->getMeeting()->getCustomer()->add($this->getCustomerValues());         
            if ($this->getSettings()->isDuplicatePhoneForbiddenConfirmed() && $this->getMeeting()->hasDuplicateConfirmed())                  
                 throw new mfException(__('Meeting already exits and confirmed. Udpate is impossible.')); 
            if ($this->getSettings()->isDuplicatePhoneForbidden() && $this->getMeeting()->getCustomer()->isPhoneNotUnique())                  
                 throw new mfException(__('Meeting already exits. Update is impossible.')); 
            mfContext::getInstance()->getEventManager()->notify(new mfEvent( $this->getMeeting()->getCustomer(), 'customer.change',array('action'=>'update')));                                      
            $this->getMeeting()->getCustomer()->save();
            if ($this->getMeeting()->getCustomer()->isPhoneNotUnique())
               $this->getWarnings()->push(__('Phone already exits.'));
            if ($this->getMeeting()->getCustomer()->isMobileNotUnique())
               $this->getWarnings()->push(__('Mobile already exits.'));
            // Address
            $this->getMeeting()->getCustomer()->getAddress()->add($this->getAddressValues());                     
            if (!$this->getMeeting()->getCustomer()->getAddress()->calculateCoordinates())
                 $this->getWarnings()->push(__("GPS coordinates can not be calculated by GoogleMap : Address should be wrong."));
            mfContext::getInstance()->getEventManager()->notify(new mfEvent( $this->getMeeting()->getCustomer()->getAddress(), 'customer.address.change',array('action'=>'update')));                                      
            $this->getMeeting()->getCustomer()->getAddress()->save();

            // Contact                        
            $this->getMeeting()->getCustomer()->getFirstContact()->add($this->getContactValues());
            if ($this->getMeeting()->getCustomer()->getFirstContact()->isNotLoaded())
            {    
               $this->getMeeting()->getCustomer()->getFirstContact()->set('customer_id',$this->getMeeting()->getCustomer());
               $this->getMeeting()->getCustomer()->getFirstContact()->setIsFirst();
            }   
            $this->getMeeting()->getCustomer()->getFirstContact()->save();                                                                                                  
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getMeeting(), 'meeting.change',array('form'=>$this,'action'=>'update')));                              
            $this->getData()->set('id',$this->getMeeting()->get('id'));
            $this->getData()->setIf(!$this->getWarnings()->isEmpty(),'warnings',$this->getWarnings()->toArray());
            return true;
        }    
        return false;
    }
    
    function getData()
    {
        return $this->data;
    }
    
}

class customers_meetings_api2UpdateMeetingAction extends mfAction {

    function execute(mfWebRequest $request) {                  
         $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
         if (!$this->getUser()->hasCredential(array(array('superadmin','customers_meetings_api2_update_meeting'))))
            $this->forwardTo401Action();                                               
        $form = new CustomerMeetingUpdateMeetingApi2Form($this->getUser(),$request->getPostParameters());       
        $this->getEventDispather()->notify(new mfEvent($form, 'meeting.form',['action'=>'view']));          
        $form->bind($request->getPostParameters());
        try
        {
            if ($form->isValid())
                return $form->getData()->toArray();    
        }
        catch (mfException $e)
        {
             return array('errors'=>$e->getMessage());
        }
        if (!$form->getNotCheckedValues())
             return array('errors'=>array('code'=>1,'text'=>'Data is empty'));
        return array('errors'=>$form->getErrorSchema()->getErrorsMessage()); 
    }

}