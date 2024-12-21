<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractNewForm.class.php";



class customers_contracts_ajaxNewContractAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    function preExecute()
    {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                 
        $this->form= new CustomerContractNewForm($request->getPostParameter('Contract'),$this->site);
        $this->item=new CustomerContract(null,$this->site); 
        $this->item->add($this->form->getDefaultValuesForMeeting());  
        if ($request->isMethod('POST') && $request->getPostParameter('Contract'))
        {          
             $this->form->bind($request->getPostParameter('Contract'));
             if ($this->form->isValid())
             {
                  
                //  var_dump($this->form['products']->getValues());
                  $messages->addInfo(__("Meeting has been created."));
                 // $this->forward('customers_meetings', 'ajaxListPartialMeeting');
             }   
             else
             {  // Repopulate
             //    var_dump($this->form->getErrorSchema()->getErrorsMessage());
               //  var_dump($this->form['contact']->getErrors());
               //  var_dump($this->form['address']->getErrors());
            //   //  var_dump($this->form['meeting']->getErrors());
                $messages->addError(__("Form has some errors."));                    
               
             }    
        }   
        else
        {    
     /*   $this->item->getCustomer()->add(array('gender'=>'Mr',
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
     /*    $this->item->getCustomer()->getFirstHouse()->add(array(                                             
                                              'area'=>'80 m²',
                                              'orientation'=>'Nord',
                                              'windows'=>"5 velux",
                                              'removal'=>'NO',                                             
                                              
                                       ));*/
        }
    }

}
