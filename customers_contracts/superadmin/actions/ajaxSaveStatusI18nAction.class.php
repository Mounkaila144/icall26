<?php


 require_once dirname(__FILE__)."/../locales/Forms/CustomerContractStatusViewForm.class.php";
 
class  customers_contracts_ajaxSaveStatusI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {             
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();     
        $this->form = new CustomerContractStatusViewForm($request->getPostParameter('CustomerContractStatusI18n'),$this->site);                    
        try
        {            
            $this->item=new CustomerContractStatusI18n($this->form->getDefault('status_i18n'),$this->site);               
            $this->form->bind($request->getPostParameter('CustomerContractStatusI18n'),$request->getFiles('CustomerContractStatusI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form['status_i18n']->getValues());
                $this->item->getCustomerContractStatus()->add($this->form['status']->getValues());  
                if ($this->item->getCustomerContractStatus()->isExist() || $this->item->isExist())
                            throw new mfException (__("status already exists"));                                                      
                if ($this->item->isNotLoaded())                
                {                           
                    $this->item->set('status_id',$this->item->getCustomerContractStatus());  
                    if ($this->form['status']->hasValue('icon'))
                    {
                        $iconFile=$this->form['status']['icon']->getValue();     
                        $this->item->getCustomerContractStatus()->set('icon',$iconFile->getFilename()); 
                        if ($iconFile)
                        {
                           $iconFile->save($this->item->getCustomerContractStatus()->getIcon()->getPath());  
                        }                               
                    }                                                                                                                                              
                }         
                $this->item->getCustomerContractStatus()->save();
                $this->item->save();
                $messages->addInfo(__('status has been saved.'));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('customers_contracts','ajaxListPartialStatus');
            }   
            else
            {                    
               $messages->addError(__('form has some errors.'));              
               $this->item->getCustomerContractStatus()->add($this->form['status']->getValues());
               $this->item->add($this->form['status_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

