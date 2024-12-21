<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractStatusNewForm.class.php";

class customers_contracts_ajaxSaveNewStatusI18nAction extends mfAction {
    
        
            
    function execute(mfWebRequest $request) {             
        if (!$request->isXmlHttpRequest() )  
        {
                if ($request->getPostParameter('iFrame')=='true') // Comes from Iframe
                       $request->forceXMLRequest();                  
        }   
        $messages = mfMessages::getInstance();                                  
        try
        {      
            $this->form= new CustomerContractStatusNewForm($this->getUser()->getCountry(),$request->getPostParameter('CustomerContractStatus'));             
            $this->customer_contract_status_i18n=new CustomerContractStatusI18n();
            $this->form->bind($request->getPostParameter('CustomerContractStatus'),$request->getFiles('CustomerContractStatus'));
            if ($this->form->isValid())
            {
                $this->customer_contract_status_i18n->getCustomerContractStatus()->add($this->form['status']->getValues());
                $this->customer_contract_status_i18n->add($this->form['status_i18n']->getValues());
                if ($this->customer_contract_status_i18n->getCustomerContractStatus()->isExist())
                    throw new mfException (__("status already exists"));   
                if ($this->form['status']->hasValue('icon'))
                {
                  $iconFile=$this->form['status']['icon']->getValue();                  
                  $this->customer_contract_status_i18n->getCustomerContractStatus()->set('icon',$iconFile->getFile()); 
                }     
                $this->customer_contract_status_i18n->getCustomerContractStatus()->save();
                if ($iconFile)
                {
                   $iconFile->save($this->customer_contract_status_i18n->getCustomerContractStatus()->getIcon()->getPath());  
                }                                                              
                $this->customer_contract_status_i18n->set('status_id',$this->customer_contract_status_i18n->getCustomerContractStatus());                                    
                if ($this->customer_contract_status_i18n->isExist())
                    throw new mfException (__("Status already exists"));                                                                                                                                       
                $this->customer_contract_status_i18n->save();
                $messages->addInfo(__("Status has been saved."));
                $request->addRequestParameter('lang',$this->customer_contract_status_i18n->get('lang'));
                $this->forward('customers_contracts','ajaxListPartialStatus');
            }   
            else
            {               
                // Repopulate
                $this->customer_contract_status_i18n->add($this->form['status_i18n']->getValues());
                $this->customer_contract_status_i18n->getCustomerContractStatus()->add($this->form['status']->getValues());
                $messages->addError("form has some errors."); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
