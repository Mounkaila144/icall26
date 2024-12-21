<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingNewForm.class.php";



class customers_meetings_ajaxNewMeetingAction extends mfAction {
    
    
 
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                 
        $this->user=$this->getUser();       
        $this->meeting_settings=CustomerMeetingSettings::load();
        $this->form= new CustomerMeetingNewForm($this->getUser(),$request->getPostParameter('Meeting'));    
        $this->getEventDispather()->notify(new mfEvent($this->form, 'meeting.new.form'));    
        if ($request->getPostParameter('MeetingDateTime'))
        {             
            $form=new MeetingDateTimeForm();
            $form->bind($request->getPostParameter('MeetingDateTime'));
            if ($form->isValid())
            {               
                $this->form->setDefaultDateTime((string)$form['date']);             
            } // else var_dump($form->getErrorSchema ());  
          //  else echo $form['date']->getError();
        }   
        $this->item=$this->form->getMeeting();
        $this->item->add($this->form->getDefaultValuesForMeeting());
     //   var_dump($this->form->getDefaultValuesForMeeting());
        if ($defaults=$request->getRequestParameter('Meeting'))
        {
            $this->item->getCustomer()->add($defaults['customer']);            
            $this->item->getCustomer()->getAddress()->add($defaults['address']);
        }    
        if ($request->isMethod('POST') && $request->getPostParameter('Meeting'))
        {  
            try
            {
             $this->form->bind($request->getPostParameter('Meeting'));
             if ($this->form->isValid())
             {               
                  // Customer
                  $this->item->getCustomer()->add($this->form['customer']->getValues());             
                  if ($this->meeting_settings->isDuplicatePhoneForbiddenConfirmed() && $this->item->hasDuplicateConfirmed())                  
                       throw new mfException(__('Meeting already exits and confirmed. Creation is impossible.'));                  
                  if ($this->meeting_settings->isDuplicatePhoneForbidden() && $this->item->getCustomer()->isPhoneNotUnique())                  
                       throw new mfException(__('Meeting already exits. Creation is impossible.'));                                                           
                  $this->item->getCustomer()->save();
                  if ($this->item->getCustomer()->isPhoneNotUnique())
                      $messages->addWarning(__('Phone already exits.'));                  
                  if ($this->item->getCustomer()->isMobileNotUnique())
                      $messages->addWarning(__('Mobile already exits.'));
                  // Contact                 
             /*     $this->item->getCustomer()->getFirstContact()->add($this->form['contact']->getValues());
                  $this->item->getCustomer()->getFirstContact()->set('customer_id',$this->item->getCustomer());
                  $this->item->getCustomer()->getFirstContact()->setIsFirst();
                  $this->item->getCustomer()->getFirstContact()->save();    */            
                  // Address
                  $this->item->getCustomer()->getAddress()->add($this->form['address']->getValues());
                  $this->item->getCustomer()->getAddress()->set('customer_id',$this->item->getCustomer());  
                  if (!$this->item->getCustomer()->getAddress()->calculateCoordinates())
                      $messages->addWarning(__("GPS coordinates can not be calculated by GoogleMap : Address should be wrong."));
                  $this->item->getCustomer()->getAddress()->save();
                  // Telepro
                  if ($this->getUser()->hasGroups('telepro') || $this->getUser()->hasCredential(array(array('meeting_new_telepro_as_user'))))
                  {                     
                       $this->item->set('telepro_id',$this->getUser()->getGuardUser());                      
                  }
                  // Call center
                   if ($this->meeting_settings->hasCallcenter() && $this->getUser()->getGuardUser()->hasCallcenter())
                        $this->item->set('callcenter_id',$this->getUser()->getGuardUser()->getCallcenter()); 
                   // Assistant
                  if ($this->meeting_settings->hasAssistant() && 
                      ($this->getUser()->hasGroups('assistant') || $this->getUser()->hasCredential(array(array('meeting_new_assistant_as_user')))) && 
                      !$this->form->meeting->hasValidator('assistant_id'))
                  {    
                        $this->item->set('assistant_id',$this->getUser()->getGuardUser()); 
                  }      
                  $this->item->add($this->form->getMeetingValues());                 
                  $this->item->set('customer_id',$this->item->getCustomer());  
                  if ($this->item->isExist())
                  {    
                      // $messages->addWarning(__('Meeting already exits.'));
                      throw new mfException(__('Meeting already exits.'));
                  }    
                  $this->item->set('created_by_id',$this->getUser()->getGuardUser());       
                  if ($this->meeting_settings->hasRegistration())
                      $this->item->register();   
                  $this->getEventDispather()->notify(new mfEvent($this->item, 'meeting.before.save',array('form'=>$this->form,'action'=>'new'))); 
               //   var_dump($this->item->get('in_at'));
                  $this->item->save();                                                    
                  if ($this->meeting_settings->get('comment_on_create')=='YES')
                      $this->item->setComments($this->getUser(),'create');                                   
                  // Products linked with meeting
                  $collection=new CustomerMeetingProductCollection();                  
                  foreach ($this->form->getProducts() as $data)
                  {
                     $item=new CustomerMeetingProduct();
                     $item->add($data);
                     $item->set('meeting_id',$this->item);
                     $collection[]=$item;
                  }    
                  $collection->save();                                    
                //  var_dump($this->form['products']->getValues());
                  $this->getEventDispather()->notify(new mfEvent($this->item, 'meeting.change',array('form'=>$this->form,'action'=>'new'))); 
                  $messages->addInfo(__("Meeting has been created."));                  
                  $request->addRequestParameter('meeting', $this->item);
                  if ($this->getUser()->hasCredential(array(array('meeting_new_jump_view'))))                              
                      $this->forward('customers_meetings', 'ajaxViewMeeting2');         
                  
             }   
             else
             {  // Repopulate      
             //    var_dump($this->form->getErrorSchema()->getErrorsMessage()); 
                if ($this->getUser()->hasCredential(array(array('superadmin_debug'))))            
                     SystemDebug::getInstance()->var_dump($this->form->getErrorSchema()->getErrorsMessage());     
                $messages->addError(__("Form has some errors."));                    
                $this->item->add($this->form['meeting']->getValues());                   
                $this->item->getCustomer()->add($this->form['customer']->getValues());
                $this->item->getCustomer()->getAddress()->add($this->form['address']->getValues());
                $this->item->getCustomer()->getFirstContact()->add($this->form['contact']->getValues());                   
             }  
             
            }
            catch (mfException $e)
            {
                $messages->addError($e);
            }
          //  var_dump($request->getPostParameter('Meeting'));
         //   echo "=>".$this->form['meeting']['in_at']['hour']."<br/>";
        }           
       else
        {              
           if (mfConfig::get('mf_env')=='dev')
           {    
                $this->item->getCustomer()->add(array('gender'=>'Mr',
                                                      'firstname'=>'frédéric',
                                                      'lastname'=>"Mallet",
                                                      'email'=>'contact'.time().'@ewebsolutions.fr',
                                                      'age'=>'env 45',
                                                      'phone'=>'0524236587',
                                                      'mobile'=>'0627107296',
                                                      //'salary'=>'30K€/an',
                                                      //'occupation'=>'Artisant'
                                               ));
                $this->item->getCustomer()->getAddress()->add(array(                                             
                                                      'address1'=>'802 rue du bois tison',
                                                      'address2'=>'',
                                                      'city'=>'saint jacques sur darnétal',
                                                      'postcode'=>'76100',
                                                      'country'=>'fr'
                                               ));
      /*  $this->item->getCustomer()->getFirstContact()->add(array(                                             
                                              'gender'=>'Ms',
                                              'firstname'=>'adam',
                                              'lastname'=>"Mallet",
                                              'email'=>'contact@ewebsolutions.fr',
                                              'age'=>'env 35',
                                              'phone'=>'0524236588',
                                              'mobile'=>'0627107298',
                                              'salary'=>'40K€/an',
                                              'occupation'=>'CDI'
                                              
                                       ));*/
           }
        }             
    }

}
