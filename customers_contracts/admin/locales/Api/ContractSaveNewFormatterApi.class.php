<?php

require_once __DIR__."/ContractNewFormatterApi.class.php";

class ContractSaveNewFormatterApi extends mfFormatterApi {
    
    function __construct($item,$form) {
        $this->action=$action;
        $this->item=$item;        
        $this->form=$form;      
        parent::__construct();
    }
    
    function getAction(){
        return  mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
    }
    
    function getUser() {
        return $this->user;
    }

    function getItem() 
    {
        
        return $this->item;
    }
    
    function getForm()
    {
        return $this->form;
    }

    function getSettings()
    {
        return $this->settings=$this->settings===null?new UserSettings():$this->settings;
    }
    
    function process()
    {      
        try
        {
                          //  $form = new ContractApiNewForm($this->getUser());           
     //   $item=new CustomerContract($request->getPostParameter('Contract'));                   
     //   $form->bind($request->getPostParameter('Contract'));        
                //$this->getAction()->getEventDispather()->notify(new mfEvent($this->getForm(), 'contract.new.form'));          
                     if ($this->getForm()->isValid())
                     {     
                         echo '++++++++++++++';
                         var_dump($this->getForm()['customer']->getValues());
                         die(__METHOD__);
                         $this->getItem()->getCustomer()->add($this->getForm()['customer']->getValues());
                         $this->getItem()->getCustomer()->save();
                         if ($this->getItem()->getCustomer()->isPhoneNotUnique())
                            $this->data['warning']=__('Phone already exits.');
                         if ($this->getItem()->getCustomer()->isMobileNotUnique())
                            $this->data['warning']=__('Mobile already exits.');
                          // Address
                         $this->getItem()->getCustomer()->getAddress()->add($this->getForm()['address']->getValues());
                         $this->getItem()->getCustomer()->getAddress()->set('customer_id',$this->getItem()->getCustomer());                  
                          if ($this->getItem()->getCustomer()->getAddress()->calculateCoordinates())
                              $messages->addWarning(__("GPS coordinates can not be calculated by GoogleMap : Address should be wrong."));
                         $this->getItem()->getCustomer()->getAddress()->save();                  
                          // Contract
                         $this->getItem()->add($this->getForm()['contract']->getValues());
                         $this->getItem()->set('customer_id',$this->getItem()->getCustomer());
                         $this->getItem()->set('team_id',$this->getForm()['attributions']['team_id']->getValue());
                          // Users for contract
                         $this->getItem()->setContributors($this->getForm()['attributions']['contributors']->getValues(),$this->getUser());
                         $this->getItem()->set('created_by_id',$this->getUser()->getGuardUser());                               
                          mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getItem(), 'contract.load',array('form'=>$this->getForm(),'action'=>'load'))); 
                         $this->getItem()->save();

                         $this->getItem()->setComments($this->getUser(),'create');   
                          // Products
                          $collection=new CustomerContractProductCollection();
                        //  var_dump($this->getForm()['products']['collection']->getValue());
                          foreach ($this->getForm()->getProducts() as $data)
                          {
                             $item=new CustomerContractProduct();
                             $item->add($data);
                             $item->set('contract_id',$this->getItem());
                             $collection[]=$item;
                          }    
                          $collection->save();                                    
                          // Attributions
                         $this->getItem()->createContributions($this->getForm()['attributions']->getValues(),$this->getUser());

                          // Create Installations by events                 
                          mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getItem(), 'contract.change',array('form'=>$this->getForm(),'action'=>'new'))); 
                        //  var_dump($this->getForm()['products']->getValues());
                          $this->data['status']=__("Contract has been created.");
                     }   
                     else
                     {  // Repopulate
                        //           
                        //echo "<pre>";  var_dump($this->getForm()->getDefault('contract'));
                        //  echo "===".$this->getForm()['contract']['pre_meeting_at']['date']."===";
                        //  var_dump($this->getForm()->getErrorSchema()->getErrorsMessage());  
                        //  var_dump(get_class($this->getForm()->contract['pre_meeting_at']));
                        // echo "===".$this->getForm()['contract']['opened_at']->getError()."===";
                        //   echo "<pre>"; var_dump($this->getForm()['contract']->getValues());
                        if ($this->getUser()->hasCredential(array(array('superadmin_debug'))))            
                             SystemDebug::getInstance()->var_dump($this->getForm()->getErrorSchema()->getErrorsMessage());                
                        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getForm(), 'contract.new.populate')); 
                        $this->getItem()->add($this->getForm()['contract']->getValues());
                        $this->getItem()->getCustomer()->add($this->getForm()['customer']->getValues());
                        $this->getItem()->getCustomer()->getAddress()->add($this->getForm()['address']->getValues());   
                      
                        echo '------echo-----';
                        var_dump($this->getForm()->getErrorSchema()->getErrorsMessage());
                          die(__METHOD__);
                        $this->data['errors']=array(
                           "error"=> __("Form has some errors."),
                           "errors"=> $this->getForm()->getErrorSchema()->getErrorsMessage());
                     }   
                $this->settings_contract=CustomerContractSettings::load();
        }
        catch (mfException $e)
        {
            $this->data['errors']=$e->getMessage();
        }
        
        
        
        return $this;
    }

    public function getData() {
        
    }

}
