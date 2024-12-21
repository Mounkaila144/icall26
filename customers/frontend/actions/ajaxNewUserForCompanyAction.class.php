<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerUserForCompanyNewForm.class.php";

class customers_ajaxNewUserForCompanyAction extends mfAction {

               
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->user=$this->getUser();  
        $this->customer_settings=  CustomerSettings::load();
        $this->form= new CustomerUserForCompanyNewForm($this->getUser(),$request->getPostParameter('CustomerUser'));                    
        $this->item=new CustomerUser();
      /*  $this->item->add(array('gender'=>'Mr',
                               'firstname'=>'Adam',
                               'lastname'=>'Elhafiani',
                               'email'=>'elhafiani'.time().'net@gmail.com',
                               'phone'=>'0241643204',
                               ));*/
      
         if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerUser'))
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
                 $messages->addInfo(__("User [%s] has been created.",(string)$this->item->getFullname()));                      
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
       // var_dump($this->pager[0]);
    }
    
}    


