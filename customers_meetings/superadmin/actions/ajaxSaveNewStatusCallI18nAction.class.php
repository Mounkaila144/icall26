<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusCallNewForm.class.php";

class customers_meetings_ajaxSaveNewStatusCallI18nAction extends mfAction {
    
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
            $this->form= new CustomerMeetingStatusCallNewForm($this->getUser()->getCountry(),$request->getPostParameter('CustomerMeetingStatusCall'),$this->site);             
            $this->customer_contract_status_i18n=new CustomerMeetingStatusCallI18n(null,$this->site);
            $this->form->bind($request->getPostParameter('CustomerMeetingStatusCall'),$request->getFiles('CustomerMeetingStatusCall'));
            if ($this->form->isValid())
            {
                $this->customer_contract_status_i18n->getStatus()->add($this->form['status']->getValues());
                $this->customer_contract_status_i18n->add($this->form['status_i18n']->getValues());
                if ($this->customer_contract_status_i18n->getStatus()->isExist())
                    throw new mfException (__("status already exists"));   
                if ($this->form['status']->hasValue('icon'))
                {
                  $iconFile=$this->form['status']['icon']->getValue();                  
                  $this->customer_contract_status_i18n->getStatus()->set('icon',$iconFile->getFile()); 
                }     
                $this->customer_contract_status_i18n->getStatus()->save();
                if ($iconFile)
                {
                   $iconFile->save($this->customer_contract_status_i18n->getStatus()->getIcon()->getPath());  
                }                                                              
                $this->customer_contract_status_i18n->set('status_id',$this->customer_contract_status_i18n->getCustomerMeetingStatus());                                    
                if ($this->customer_contract_status_i18n->isExist())
                    throw new mfException (__("status already exists"));                                                                                                                                       
                $this->customer_contract_status_i18n->save();
                $messages->addInfo("Status has been saved.");
                $request->addRequestParameter('lang',$this->customer_contract_status_i18n->get('lang'));
                $this->forward('customers_meetings','ajaxListPartialStatusCall');
            }   
            else
            {               
                // Repopulate
                $this->customer_contract_status_i18n->add($this->form['status_i18n']->getValues());
                $this->customer_contract_status_i18n->getStatus()->add($this->form['status']->getValues());
                $messages->addError("form has some errors."); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
