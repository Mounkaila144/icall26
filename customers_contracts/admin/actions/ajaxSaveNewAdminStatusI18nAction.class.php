<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractAdminStatusNewForm.class.php";

class customers_contracts_ajaxSaveNewAdminStatusI18nAction extends mfAction {
    
        
            
    function execute(mfWebRequest $request) {             
        if (!$request->isXmlHttpRequest() )  
        {
                if ($request->getPostParameter('iFrame')=='true') // Comes from Iframe
                       $request->forceXMLRequest();                  
        }   
        $messages = mfMessages::getInstance();                                  
        try
        {      
            $this->form= new CustomerContractAdminStatusNewForm($this->getUser()->getCountry(),$request->getPostParameter('CustomerContractAdminStatus'));             
            $this->item_i18n=new CustomerContractAdminStatusI18n();
            $this->form->bind($request->getPostParameter('CustomerContractAdminStatus'),$request->getFiles('CustomerContractAdminStatus'));
            if ($this->form->isValid())
            {
                $this->item_i18n->getStatus()->add($this->form['status']->getValues());
                $this->item_i18n->add($this->form['status_i18n']->getValues());
                if ($this->item_i18n->getStatus()->isExist())
                    throw new mfException (__("status already exists"));   
                if ($this->form['status']->hasValue('icon'))
                {
                  $iconFile=$this->form['status']['icon']->getValue();                  
                  $this->item_i18n->getStatus()->set('icon',$iconFile->getFile()); 
                }     
                $this->item_i18n->getStatus()->save();
                if ($iconFile)
                {
                   $iconFile->save($this->item_i18n->getStatus()->getIcon()->getPath());  
                }                                                              
                $this->item_i18n->set('status_id',$this->item_i18n->getStatus());                                    
                if ($this->item_i18n->isExist())
                    throw new mfException (__("Status already exists"));                                                                                                                                       
                $this->item_i18n->save();
                $messages->addInfo(__("Status has been saved."));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('customers_contracts','ajaxListPartialAdminStatus');
            }   
            else
            {               
                // Repopulate
                $this->item_i18n->add($this->form['status_i18n']->getValues());
                $this->item_i18n->getStatus()->add($this->form['status']->getValues());
                $messages->addError(__("Form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
