<?php

// www.ecosol16.net/admin/api/v2/customers/contracts/admin//UpdateContract

require_once __DIR__."/../locales/Forms/CustomerContractViewForm.class.php";

class CustomerContractUpdateContractApi2Form extends CustomerContractViewForm {
    
    function __construct($user,$defaults=array()) {
        $this->user=$user;
        $this->data=new mfArray();
        $this->settings=new CustomerContractSettings();     
        $this->warnings=new mfArray();
        parent::__construct($user,new CustomerContract($defaults['id']),$defaults);
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
            //$this->getContract()->add($this['contract']->getValues());  
            // Comment  
             $this->getContract()->add($this->getValues());
                 $this->getContract()->setComments($this->getUser());                                    
                  mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getContract(), 'contract.change',array('action'=>'update','form'=>$this)));                                      
                 if ($this->getUser()->hasCredential(array(array('contract_check_opc_at_date'))) && !$this->getContract()->isValidDateOpcAt())
                     throw new mfException(__("'Opc' date has to be above or equal [%s].",$this->getContract()->getAuthorizedOpcDate()->getText()));                                  
                 $this->getContract()->save();                            
            $this->getData()->set('id',$this->getContract()->get('id'));
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

class customers_contracts_api2UpdateContractAction extends mfAction {

    function execute(mfWebRequest $request) {                  
         $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
         if (!$this->getUser()->hasCredential(array(array('superadmin','customers_contracts_api2_update_contract'))))
            $this->forwardTo401Action();                                               
        $form = new CustomerContractUpdateContractApi2Form($this->getUser(),$request->getPostParameters());       
        $this->getEventDispather()->notify(new mfEvent($form, 'contract.form',$form->getContract()));   
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