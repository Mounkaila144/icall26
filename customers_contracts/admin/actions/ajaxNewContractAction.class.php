<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractNewForm.class.php";



class customers_contracts_ajaxNewContractAction extends mfAction {
    
                       
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                
        $this->user=$this->getUser();       
        $this->form= new CustomerContractNewForm($this->user,$request->getPostParameter('CustomerContract'));         
        $this->getEventDispather()->notify(new mfEvent($this->form, 'contract.new.form'));          
        $this->contract=$this->form->getCOntract(); //new CustomerContract();                    
        if (mfConfig::get('mf_env')=='dev')     $this->prePopulate();
        if ($request->isMethod('POST') && $request->getPostParameter('CustomerContract'))
        {          
             $this->form->bind($request->getPostParameter('CustomerContract'));
             if ($this->form->isValid())
             {                       
                  $this->contract->getCustomer()->add($this->form['customer']->getValues());
                  $this->contract->getCustomer()->save();
                   if ($this->contract->getCustomer()->isPhoneNotUnique())
                      $messages->addWarning(__('Phone already exits.'));
                  if ($this->contract->getCustomer()->isMobileNotUnique())
                      $messages->addWarning(__('Mobile already exits.'));                  
                  // Address
                  $this->contract->getCustomer()->getAddress()->add($this->form['address']->getValues());
                  $this->contract->getCustomer()->getAddress()->set('customer_id',$this->contract->getCustomer());                  
                  if (!$this->contract->getCustomer()->getAddress()->calculateCoordinates())
                      $messages->addWarning(__("GPS coordinates can not be calculated by GoogleMap : Address should be wrong."));
                  $this->contract->getCustomer()->getAddress()->save();                  
                  // Contract
                  $this->contract->add($this->form['contract']->getValues());
                  $this->contract->set('customer_id',$this->contract->getCustomer());
                  $this->contract->set('team_id',$this->form['attributions']['team_id']->getValue());
                  // Users for contract
                  $this->contract->setContributors($this->form['attributions']['contributors']->getValues(),$this->getUser());
                  $this->contract->set('created_by_id',$this->getUser()->getGuardUser());                               
                  mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->contract, 'contract.load',array('form'=>$this->form,'action'=>'load'))); 
                  $this->contract->save();
                  
                  $this->contract->setComments($this->getUser(),'create');   
                  // Products
                  $collection=new CustomerContractProductCollection();
                //  var_dump($this->form['products']['collection']->getValue());
                  foreach ($this->form->getProducts() as $data)
                  {
                     $item=new CustomerContractProduct();
                     $item->add($data);
                     $item->set('contract_id',$this->contract);
                     $collection[]=$item;
                  }    
                  $collection->save();                                    
                  // Attributions
                  $this->contract->createContributions($this->form['attributions']->getValues(),$this->getUser());
                  
                  // Create Installations by events                 
                  mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->contract, 'contract.change',array('form'=>$this->form,'action'=>'new'))); 
                //  var_dump($this->form['products']->getValues());
                  $messages->addInfo(__("Contract has been created."));
                  $request->addRequestParameter('contract', $this->contract);
                  if ($this->getUser()->hasCredential(array(array('contract_new_jump_view'))))     
                  {                        
                     $this->forward('customers_contracts', 'ajaxViewContract');       
                  }
             }   
             else
             {  // Repopulate
             //           
              //echo "<pre>";  var_dump($this->form->getDefault('contract'));
            //  echo "===".$this->form['contract']['pre_meeting_at']['date']."===";
              //  var_dump($this->form->getErrorSchema()->getErrorsMessage());  
               //  var_dump(get_class($this->form->contract['pre_meeting_at']));
                // echo "===".$this->form['contract']['opened_at']->getError()."===";
              //   echo "<pre>"; var_dump($this->form['contract']->getValues());
                 if ($this->getUser()->hasCredential(array(array('superadmin_debug'))))            
                     SystemDebug::getInstance()->var_dump($this->form->getErrorSchema()->getErrorsMessage());                
                mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->form, 'contract.new.populate')); 
                $this->contract->add($this->form['contract']->getValues());
                $this->contract->getCustomer()->add($this->form['customer']->getValues());
                $this->contract->getCustomer()->getAddress()->add($this->form['address']->getValues());   
               
                $messages->addError(__("Form has some errors."));                                   
             }    
        }      
        $this->settings_contract=CustomerContractSettings::load();
    }

    
    function prePopulate()
    {
      /*  $this->contract->add(array("opened_at"=> null, "total_price_with_taxe"=> "0,00" , "tax_id"=> "2", "total_price_without_taxe"=> "0,00" , "financial_partner_id"=> "" ,
                                  "apf_at"=> "", "opc_at"=> "",  "payment_at"=> "","reference"=> "",
                                      )
                );*/
       $this->contract->getCustomer()->add(array("lastname"=> "TESTA_".time(),
                                           "firstname"=> "frédéric",
                                           "phone"=> "0524236587",
                                           "mobile"=> "0627107296",
                                           "mobile2"=> "",
                                           "email"=> "contact".time()."@ewebsolutions.fr" ,
                                           "gender"=> "Mr"
                                       ));
      $this->contract->getCustomer()->getAddress()->add(array("address1"=> "802 rue du bois tison","address2"=> "","postcode"=> "76100","city"=> "saint jacques sur darnétal"));           
    }
}
