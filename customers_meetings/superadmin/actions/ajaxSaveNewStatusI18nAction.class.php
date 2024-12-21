<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusNewForm.class.php";

class customers_meetings_ajaxSaveNewStatusI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
            
    function execute(mfWebRequest $request) {             
        if (!$request->isXmlHttpRequest() )  
        {
                if ($request->getPostParameter('iFrame')=='true') // Comes from Iframe
                       $request->forceXMLRequest();                  
        }   
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                                 
        try
        {      
            $this->form= new CustomerMeetingStatusNewForm($this->getUser()->getCountry(),$request->getPostParameter('CustomerMeetingStatus'),$this->site);             
            $this->customer_contract_status_i18n=new CustomerMeetingStatusI18n(null,$this->site);
            $this->form->bind($request->getPostParameter('CustomerMeetingStatus'),$request->getFiles('CustomerMeetingStatus'));
            if ($this->form->isValid())
            {
                $this->customer_contract_status_i18n->getCustomerMeetingStatus()->add($this->form['status']->getValues());
                $this->customer_contract_status_i18n->add($this->form['status_i18n']->getValues());
                if ($this->customer_contract_status_i18n->getCustomerMeetingStatus()->isExist())
                    throw new mfException (__("status already exists"));   
                if ($this->form['status']->hasValue('icon'))
                {
                  $iconFile=$this->form['status']['icon']->getValue();                  
                  $this->customer_contract_status_i18n->getCustomerMeetingStatus()->set('icon',$iconFile->getFile()); 
                }     
                $this->customer_contract_status_i18n->getCustomerMeetingStatus()->save();
                if ($iconFile)
                {
                   $iconFile->save($this->customer_contract_status_i18n->getCustomerMeetingStatus()->getIcon()->getPath());  
                }                                                              
                $this->customer_contract_status_i18n->set('status_id',$this->customer_contract_status_i18n->getCustomerMeetingStatus());                                    
                if ($this->customer_contract_status_i18n->isExist())
                    throw new mfException (__("status already exists"));                                                                                                                                       
                $this->customer_contract_status_i18n->save();
                $messages->addInfo("Status has been saved.");
                $request->addRequestParameter('lang',$this->customer_contract_status_i18n->get('lang'));
                $this->forward('customers_meetings','ajaxListPartialStatus');
            }   
            else
            {               
                // Repopulate
                $this->customer_contract_status_i18n->add($this->form['status_i18n']->getValues());
                $this->customer_contract_status_i18n->getCustomerMeetingStatus()->add($this->form['status']->getValues());
                $messages->addError("form has some errors."); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
