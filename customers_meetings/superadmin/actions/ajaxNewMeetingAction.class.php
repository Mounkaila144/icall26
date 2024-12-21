<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingNewForm.class.php";



class customers_meetings_ajaxNewMeetingAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    function preExecute()
    {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");              
        $this->meeting_settings=CustomerMeetingSettings::load($this->site);         
        $this->form= new CustomerMeetingNewForm($request->getPostParameter('Meeting'),$this->site);
        $this->getEventDispather()->notify(new mfEvent($this->form, 'meeting.form'));         
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
      //  var_dump($request->getPostParameter('Meeting'));
        $this->item=new CustomerMeeting(null,$this->site); 
        $this->item->add($this->form->getDefaultValuesForMeeting());          
        if ($request->isMethod('POST') && $request->getPostParameter('Meeting'))
        {          
             $this->form->bind($request->getPostParameter('Meeting'));
             if ($this->form->isValid())
             {
                  // Customer
                  $this->item->getCustomer()->add($this->form['customer']->getValues());
                  $this->item->getCustomer()->save();
                  // Contact                 
                //  $this->item->getCustomer()->getFirstContact()->add($this->form['contact']->getValues());
                //  $this->item->getCustomer()->getFirstContact()->set('customer_id',$this->item->getCustomer());
               //   $this->item->getCustomer()->getFirstContact()->setIsFirst();
               //   $this->item->getCustomer()->getFirstContact()->save();                
                  // Address
                  $this->item->getCustomer()->getAddress()->add($this->form['address']->getValues());
                  $this->item->getCustomer()->getAddress()->set('customer_id',$this->item->getCustomer());  
                  if (!$this->item->getCustomer()->getAddress()->calculateCoordinates())                 
                      $messages->addWarning(__("GPS coordinates can not be calculated by GoogleMap : Address should be wrong."));
                  $this->item->getCustomer()->getAddress()->save();
                  // Financial
                //  $this->item->getCustomer()->getFinancial()->add($this->form['financial']->getValues()); 
                //  $this->item->getCustomer()->getFinancial()->set('customer_id',$this->item->getCustomer());
                //  $this->item->getCustomer()->getFinancial()->save();
                  // House
                //  $this->item->getCustomer()->getFirstHouse()->add($this->form['house']->getValues());
                //  $this->item->getCustomer()->getFirstHouse()->set('customer_id',$this->item->getCustomer());
                //  $this->item->getCustomer()->getFirstHouse()->set('address_id',$this->item->getCustomer()->getAddress());
                //  $this->item->getCustomer()->getFirstHouse()->save();
                  // Meeting
                  $this->item->add($this->form['meeting']->getValues());                 
                  $this->item->set('customer_id',$this->item->getCustomer());
                  $this->item->save();                  
                  // Products linked with meeting
                  $collection=new CustomerMeetingProductCollection(null,$this->site);
                //  var_dump($this->form['products']['collection']->getValue());
                  foreach ($this->form['products']['collection']->getValues() as $data)
                  {
                     $item=new CustomerMeetingProduct(null,$this->site);
                     $item->add($data);
                     $item->set('meeting_id',$this->item);
                     $collection[]=$item;
                  }    
                  $collection->save();
                //  var_dump($this->form['products']->getValues());
                  $this->getEventDispather()->notify(new mfEvent($this->item, 'meeting.change',array('form'=>$this->form,'action'=>'new'))); 
                  $messages->addInfo(__("Meeting has been created."));
                 // $this->forward('customers_meetings', 'ajaxListPartialMeeting');
             }   
             else
             {  // Repopulate
             // var_dump($this->form['meeting']->getValues());
            //    var_dump($this->form->getErrorSchema()->getErrorsMessage());
               //  var_dump($this->form['contact']->getErrors());
               //  var_dump($this->form['address']->getErrors());
            //   //  var_dump($this->form['meeting']->getErrors());
                $messages->addError(__("Form has some errors."));                    
                $this->item->add($this->form['meeting']->getValues());                   
                $this->item->getCustomer()->add($this->form['customer']->getValues());
                $this->item->getCustomer()->getAddress()->add($this->form['address']->getValues());
           //     $this->item->getCustomer()->getFirstContact()->add($this->form['contact']->getValues());
            //    $this->item->getCustomer()->getFirstHouse()->add($this->form['house']->getValues());
            //    $this->item->getCustomer()->getFinancial()->add($this->form['financial']->getValues());
            //    var_dump($this->form['meeting']['in_at']['date']);
                
             }    
        }   
        else
        {    
        $this->item->getCustomer()->add(array('gender'=>'Mr',
                                              'firstname'=>'frédéric',
                                              'lastname'=>"Mallet",
                                              'email'=>'contact'.time().'@ewebsolutions.fr',
                                              'age'=>'env 45',
                                              'phone'=>'0524236587',
                                              'mobile'=>'0627107296',
                                              'salary'=>'30K€/an',
                                              'occupation'=>'Artisant'
                                       ));
        $this->item->getCustomer()->getAddress()->add(array(                                             
                                              'address1'=>'802 rue du bois tison',
                                              'address2'=>'',
                                              'city'=>'saint jacques sur darnétal',
                                              'postcode'=>'76100',
                                              'country'=>'fr'
                                       ));     
       /*  $this->item->getCustomer()->getFirstHouse()->add(array(                                             
                                              'area'=>'80 m²',
                                              'orientation'=>'Nord',
                                              'windows'=>"5 velux",
                                              'removal'=>'NO',                                             
                                              
                                       ));*/
        }
    }

}
