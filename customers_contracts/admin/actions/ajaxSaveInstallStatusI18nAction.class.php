<?php


 require_once dirname(__FILE__)."/../locales/Forms/CustomerContractInstallStatusViewForm.class.php";
 
class  customers_contracts_ajaxSaveInstallStatusI18nAction extends mfAction {
    
   
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new CustomerContractInstallStatusViewForm($request->getPostParameter('CustomerContractInstallStatusI18n'));                    
        try
        {            
            $this->item_i18n=new CustomerContractInstallStatusI18n($this->form->getDefault('status_i18n'));               
            $this->form->bind($request->getPostParameter('CustomerContractInstallStatusI18n'),$request->getFiles('CustomerContractInstallStatusI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item_i18n->add($this->form['status_i18n']->getValues());
                $this->item_i18n->getStatus()->add($this->form['status']->getValues());  
                if ($this->item_i18n->getStatus()->isExist() || $this->item_i18n->isExist())
                            throw new mfException (__("status already exists"));                                                      
                if ($this->item_i18n->isNotLoaded())                
                {                           
                    $this->item_i18n->set('status_id',$this->item_i18n->getStatus());  
                    if ($this->form['status']->hasValue('icon'))
                    {
                        $iconFile=$this->form['status']['icon']->getValue();     
                        $this->item_i18n->getStatus()->set('icon',$iconFile->getFilename()); 
                        if ($iconFile)
                        {
                           $iconFile->save($this->item_i18n->getStatus()->getIcon()->getPath());  
                        }                               
                    }                                                                                                                                              
                }         
                $this->item_i18n->getStatus()->save();
                $this->item_i18n->save();
                $messages->addInfo(__('status has been saved.'));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('customers_contracts','ajaxListPartialInstallStatus');
            }   
            else
            {                    
               $messages->addError(__('form has some errors.'));              
               $this->item_i18n->getStatus()->add($this->form['status']->getValues());
               $this->item_i18n->add($this->form['status_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

