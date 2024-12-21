<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForm.class.php";

class customers_meetings_ajaxSaveMeetingAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    function preExecute()
    {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                    
        $this->form= new CustomerMeetingViewForm($request->getPostParameter('Meeting'),$this->site);
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'),$this->site); 
        try
        {
            if ($request->isMethod('POST') && $request->getPostParameter('Meeting'))
            {          
                 $this->form->bind($request->getPostParameter('Meeting'));
                 if ($this->form->isValid())
                 {
                     // Meeting
                     $this->meeting->add($this->form['meeting']->getValues());  
                   //  var_dump($this->form['meeting']->getValues());
                     // Comment  
                     $this->meeting->setComments($this->getUser());                                                             
                     $this->meeting->save();
                     // Customer
                     $this->meeting->getCustomer()->add($this->form['customer']->getValues());
                     $this->meeting->getCustomer()->save();
                     // Address
                     $this->meeting->getCustomer()->getAddress()->add($this->form['address']->getValues());
                     if (!$this->meeting->getCustomer()->getAddress()->calculateCoordinates())
                          $messages->addWarning(__("GPS coordinates can not be calculated by GoogleMap : Address should be wrong."));
                     $this->meeting->getCustomer()->getAddress()->save();
                     // Contact                        
                 /*    $this->meeting->getCustomer()->getFirstContact()->add($this->form['contact']->getValues());
                     if ($this->meeting->getCustomer()->getFirstContact()->isNotLoaded())
                     {    
                        $this->meeting->getCustomer()->getFirstContact()->set('customer_id',$this->meeting->getCustomer());
                        $this->meeting->getCustomer()->getFirstContact()->setIsFirst();
                     }   
                     $this->meeting->getCustomer()->getFirstContact()->save();   */                  
                     // House
                    // $this->meeting->getCustomer()->getFirstHouse()->add($this->form['house']->getValues());
                    // $this->meeting->getCustomer()->getFirstHouse()->save();
                     // FInancial
                    // $this->meeting->getCustomer()->getFinancial()->add($this->form['financial']->getValues());
                    // $this->meeting->getCustomer()->getFinancial()->save();   
                     $messages->addInfo(__("Meeting has been updated."));   
                     $this->getEventDispather()->notify(new mfEvent($this->meeting, 'meeting.change','update'));                     
                     // JSON en sortie ?
                 }
                 else
                 {
                  //   var_dump($this->form->getErrorSchema()->getErrorsMessage());
                    $messages->addError(__("Form has some errors."));                                                  
                    $this->meeting->add($this->form['meeting']->getValues());                              
                    $this->meeting->getCustomer()->add($this->form['customer']->getValues());
                    $this->meeting->getCustomer()->getAddress()->add($this->form['address']->getValues());
                //    $this->meeting->getCustomer()->getFirstContact()->add($this->form['contact']->getValues());
                  //  $this->meeting->getCustomer()->getFirstHouse()->add($this->form['house']->getValues());
                 //   $this->meeting->getCustomer()->getFinancial()->add($this->form['financial']->getValues());
                 }    
            }   
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
         $this->meeting_settings=CustomerMeetingSettings::load($this->site);
       // var_dump( $this->meeting->getCustomer()->getFirstHouse());
    }

}
