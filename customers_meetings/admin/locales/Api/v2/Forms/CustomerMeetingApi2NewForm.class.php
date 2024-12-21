<?php

require_once __DIR__.'/../../../Forms/CustomerMeetingNewForm.class.php';

class CustomerMeetingApi2NewForm extends CustomerMeetingNewForm {
            
    function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
        $this->data=new mfArray();
        $this->warnings=new mfArray();
        //$this->validatorSchema->removePostValidator();
    }
    
    function getMeeting()
    {
        if ($this->_meeting==null)
        {           
             $this->_meeting=new CustomerMeeting();  
             $this->_meeting->add($this->getDefaultValuesForMeeting());
        }   
        return $this->_meeting;
    }
    
    function getErrors()
    {
        return $this->errors;
    }
     function getData()
    {
        return $this->data;
    } 
    
     function toArray()
    {
        return $this->getData()->toArray();
    } 
    
    function isValid()
    {
        if (parent::isValid())
        {
            if ($this->processed)
                return true;
            $this->processed=true;
            try
            {                                   
               $this->getMeeting()->getCustomer()->add($this['customer']->getValues());                  
               if ($this->getSettings()->isDuplicatePhoneForbiddenConfirmed() && $this->getMeeting()->hasDuplicateConfirmed())                  
                       throw new mfException(__('meeting already exits and confirmed. creation is impossible.'));                  
               if ($this->getSettings()->isDuplicatePhoneForbidden() && $this->getMeeting()->getCustomer()->isPhoneNotUnique())                  
                       throw new mfException(__('meeting already exits. creation is impossible.'));                                                           
                  $this->getMeeting()->getCustomer()->save();
                  if ($this->getMeeting()->getCustomer()->isPhoneNotUnique())
                      $this->warnings->push(__('phone already exits.'));                  
                  if ($this->getMeeting()->getCustomer()->isMobileNotUnique())
                       $this->warnings->push(__('mobile already exits.'));             
                  // Address
                  $this->getMeeting()->getCustomer()->getAddress()->add($this['address']->getValues());
                  $this->getMeeting()->getCustomer()->getAddress()->set('customer_id',$this->getMeeting()->getCustomer());  
                  if (!$this->getMeeting()->getCustomer()->getAddress()->calculateCoordinates())
                           $this->warnings->push(__("GPS coordinates can not be calculated by GoogleMap : Address should be wrong."));
                  $this->getMeeting()->getCustomer()->getAddress()->save();
                  // Telepro
                  if ($this->getUser()->hasGroups('telepro') || $this->getUser()->hasCredential(array(array('meeting_new_telepro_as_user'))))                                  
                       $this->getMeeting()->set('telepro_id',$this->getUser()->getGuardUser());                                        
                  // Call center
                   if ($this->getSettings()->hasCallcenter() && $this->getUser()->getGuardUser()->hasCallcenter())
                        $this->getMeeting()->set('callcenter_id',$this->getUser()->getGuardUser()->getCallcenter()); 
                   // Assistant
                  if ($this->getSettings()->hasAssistant() && 
                      ($this->getUser()->hasGroups('assistant') || $this->getUser()->hasCredential(array(array('meeting_new_assistant_as_user')))) && 
                      !$this->meeting->hasValidator('assistant_id'))
                  {    
                        $this->getMeeting()->set('assistant_id',$this->getUser()->getGuardUser()); 
                  }      
                  $this->getMeeting()->add($this->getMeetingValues());                 
                  $this->getMeeting()->set('customer_id',$this->getMeeting()->getCustomer());  
                  if ($this->getMeeting()->isExist())                  
                      throw new mfException(__('meeting already exits.'));                  
                  $this->getMeeting()->set('created_by_id',$this->getUser()->getGuardUser());       
                  if ($this->getSettings()->hasRegistration())
                      $this->getMeeting()->register();   
                  mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getMeeting(), 'meeting.before.save',array('form'=>$this,'action'=>'new')));                
                  $this->getMeeting()->save();                                                    
                  if ($this->getSettings()->get('comment_on_create')=='YES')
                      $this->getMeeting()->setComments($this->getUser(),'create');                                                     
                  $collection=new CustomerMeetingProductCollection();                  
                  foreach ($this->getProducts() as $data)
                  {
                     $item=new CustomerMeetingProduct();
                     $item->add($data);
                     $item->set('meeting_id',$this->getMeeting());
                     $collection[]=$item;
                  }    
                  $collection->save();                                                    
                 mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getMeeting(), 'meeting.change',array('form'=>$this,'action'=>'new'))); 
                 $this->data['id']=$this->getMeeting()->get('id');
            }
            catch (mfException $e)
            {                              
                $this->data['errors']=(string)$e->getMessage();
                return false;
            }           
            $this->getData()->setIf(!$this->warnings->isEmpty(),'warnings',$this->warnings);
            return true;
        }
        $this->data['errors']=$this->getErrorSchema()->getErrorsMessage(); 
        return false;
    }
}
