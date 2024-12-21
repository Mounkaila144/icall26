<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForm.class.php";

class customers_meetings_ajaxSaveMeeting2Action extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();           
        $this->user=$this->getUser();
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'));        
        $this->form= new CustomerMeetingViewForm($this->user,$this->meeting,$request->getPostParameter('Meeting'));
        $this->getEventDispather()->notify(new mfEvent($this->form, 'meeting.form'));  
        $this->meeting_settings=CustomerMeetingSettings::load();     
        if ($this->meeting->isHold())
        {    
             $messages->addWarning(__('Meeting is hold.')); 
             return ;
        }     
        try
        {
            if ($request->isMethod('POST') && $request->getPostParameter('Meeting'))
            {          
                 $this->form->bind($request->getPostParameter('Meeting'));
                 if ($this->form->isValid())
                 {
                     // Meeting
                     $this->meeting->add($this->form['meeting']->getValues());  
                     // Comment  
                     $this->meeting->setComments($this->getUser());  
                     if (!$this->form->meeting->hasValidator('assistant_id'))
                          $this->meeting->updateAssistant($this->user);                        
                     $this->getEventDispather()->notify(new mfEvent($this->meeting, 'meeting.update',array('form'=>$this->form,'action'=>'update')));                                      
                     $this->meeting->save();                   
                     // Customer
                     $this->meeting->getCustomer()->add($this->form->getCustomerValues());         
                     if ($this->meeting_settings->isDuplicatePhoneForbiddenConfirmed() && $this->meeting->hasDuplicateConfirmed())                  
                          throw new mfException(__('Meeting already exits and confirmed. Udpate is impossible.')); 
                     if ($this->meeting_settings->isDuplicatePhoneForbidden() && $this->meeting->getCustomer()->isPhoneNotUnique())                  
                          throw new mfException(__('Meeting already exits. Update is impossible.')); 
                     $this->getEventDispather()->notify(new mfEvent( $this->meeting->getCustomer(), 'customer.change',array('action'=>'update')));                                      
                     $this->meeting->getCustomer()->save();
                     if ($this->meeting->getCustomer()->isPhoneNotUnique())
                        $messages->addWarning(__('Phone already exits.'));
                     if ($this->meeting->getCustomer()->isMobileNotUnique())
                        $messages->addWarning(__('Mobile already exits.'));
                     // Address
                     $this->meeting->getCustomer()->getAddress()->add($this->form->getAddressValues());                     
                     if (!$this->meeting->getCustomer()->getAddress()->calculateCoordinates())
                          $messages->addWarning(__("GPS coordinates can not be calculated by GoogleMap : Address should be wrong."));
                     $this->getEventDispather()->notify(new mfEvent( $this->meeting->getCustomer()->getAddress(), 'customer.address.change',array('action'=>'update')));                                      
                     $this->meeting->getCustomer()->getAddress()->save();
                     
                     // Contact                        
                     $this->meeting->getCustomer()->getFirstContact()->add($this->form->getContactValues());
                     if ($this->meeting->getCustomer()->getFirstContact()->isNotLoaded())
                     {    
                        $this->meeting->getCustomer()->getFirstContact()->set('customer_id',$this->meeting->getCustomer());
                        $this->meeting->getCustomer()->getFirstContact()->setIsFirst();
                     }   
                     $this->meeting->getCustomer()->getFirstContact()->save();                                                           
                     $messages->addInfo(__("Meeting has been updated."));  
                    
                     $this->getEventDispather()->notify(new mfEvent($this->meeting, 'meeting.change',array('form'=>$this->form,'action'=>'update')));                     
                     
                 }
                 else
                 {
                        if ($this->getUser()->hasCredential(array(array('superadmin_debug'))))            
                     SystemDebug::getInstance()->var_dump($this->form->getErrorSchema()->getErrorsMessage());     
                //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
                    $messages->addError(__("Form has some errors."));                                                  
                    $this->meeting->add($this->form['meeting']->getValues());                         
                    $this->meeting->getCustomer()->add($this->form->getCustomerValues());                   
                    $this->meeting->getCustomer()->getAddress()->add($this->form->getAddressValues());                  
                    $this->meeting->getCustomer()->getFirstContact()->add($this->form->getContactValues());
                 //   $this->meeting->getCustomer()->getFirstHouse()->add($this->form['house']->getValues());
                 //   $this->meeting->getCustomer()->getFinancial()->add($this->form['financial']->getValues());
                    $this->getEventDispather()->notify(new mfEvent($this->meeting, 'meeting.change',array('form'=>$this->form,'action'=>'populate')));                     
                 }    
            }   
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
       // var_dump( $this->meeting->getCustomer()->getFirstHouse());
    }

}
