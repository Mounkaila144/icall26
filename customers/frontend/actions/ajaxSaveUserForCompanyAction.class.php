<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerUserForCompanyForm.class.php";

class customers_ajaxSaveUserForCompanyAction extends mfAction {

               
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->user=$this->getUser();  
        $this->customer_settings=  CustomerSettings::load();
        $this->form= new CustomerUserForCompanyNewForm($this->getUser(),$request->getPostParameter('CustomerUser'));                    
        $this->item=new CustomerUser($request->getPostParameter('CustomerUser'),$this->user->getGuardUser());   
         if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerUser') || $this->item->isNotLoaded())
            return ; 
        try
        {
            $this->form->bind($request->getPostParameter('CustomerUser'));
            if ($this->form->isValid())
            {                                
                 $this->item->add($this->form->getValues());
                 $this->item->set('company_id',$this->user->getGuardUser()->getCompany());
                 if ($this->item->isExist())
                     throw new mfException(__('User already exists.'));                                                  
                 $this->item->encryptPassword();
                 $this->item->save();                                                 
                 $this->getEventDispather()->notify(new mfEvent($this->item, 'customer.change','new')); 
                 $messages->addInfo(__("User [%s] has been updated.",(string)$this->item->getFullname()));                      
                 $this->forward('customers','ajaxListPartialUserForCompany');
            }   
            else
            {   
                // echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
                // Repopulate
                $this->item->add($this->form->getDefaults());                                                                                            
                $messages->addError("Form has some errors."); 
            } 
            
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }                
    }
    
}    


