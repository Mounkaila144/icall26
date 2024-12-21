<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractViewForm.class.php";



class customers_contracts_ajaxSaveContractAction extends mfAction {
    
            
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance(); 
        $this->user=$this->getUser();                
        $this->settings_contract=CustomerContractSettings::load();           
        $this->contract=new CustomerContract($request->getPostParameter('Contract'));  
        $this->form= new CustomerContractViewForm($this->user, $this->contract,$request->getPostParameter('Contract'));      
        $this->getEventDispather()->notify(new mfEvent($this->form, 'contract.form',$this->contract));        
        $request->addRequestParameter('contract', $this->contract);
        if ($this->contract->isNotLoaded())
            return ;
        if (!$request->isMethod('POST') || !$request->getPostParameter('Contract'))
             return ;
        try
        {
            $this->getEventDispather()->notify(new mfEvent($this->contract, 'contract.pre_execute',$this->contract));     
            if ($this->contract->isHold())
            {    
                $messages->addWarning(__("Contract is hold."));
                return ;
            }
            $this->form->bind($request->getPostParameter('Contract'));
            if ($this->form->isValid())
            {
               // echo "<pre>"; var_dump($this->form->getValues());                
                 $this->contract->add($this->form->getValues());
                 $this->contract->setComments($this->getUser());                                    
                 $this->getEventDispather()->notify(new mfEvent($this->contract, 'contract.change',array('action'=>'update','form'=>$this->form)));                                      
                 if ($this->getUser()->hasCredential(array(array('contract_check_opc_at_date'))) && !$this->contract->isValidDateOpcAt())
                     throw new mfException(__("'Opc' date has to be above or equal [%s].",$this->contract->getAuthorizedOpcDate()->getText()));                                  
                 $this->contract->save(); 
               //  if (!$this->contract->getCustomer()->getAddress()->calculateCoordinates())
               //      $messages->addWarning(__("GPS coordinates can not be calculated by GoogleMap : Address should be wrong."));                
                 $messages->addInfo(__("Contract has been saved."));                 
            }   
            else
            {         
              //  echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
               // echo "Error".$this->form['multi']['works'][2]['pack_quantity']->getError()."<br/>";
              echo "<!-- "; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo " -->";
                $messages->addError(__("Form has some errors."));
                $this->contract->add($request->getPostParameter('Contract'));
                if ($this->getUser()->hasCredential(array(array('superadmin_debug'))))            
                     SystemDebug::getInstance()->var_dump($this->form->getErrorSchema()->getErrorsMessage());                
                 $this->getEventDispather()->notify(new mfEvent($this->contract, 'contract.change',array('form'=>$this->form,'action'=>'populate'))); 
                 
                 
              //  echo "<pre>";  var_dump($this->form['multi']['works'][0]); //,$this->form['multi']['works'][1]->getValues(),$this->form['multi']['works'][0]['boiler_quantity']->getValue(),$this->form['multi']['works'][1]['surface_ite']->getValue()); 
              //  echo "</pre>";
            }
        }
        catch (mfException $e)
        {
           $messages->addError($e); 
        }
       
    }

}
