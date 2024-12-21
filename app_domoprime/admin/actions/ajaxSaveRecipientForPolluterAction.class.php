<?php

require_once dirname(__FILE__).'/../locales/Forms/CustomerContractRecipientForPolluterViewForm.class.php';

class app_domoprime_ajaxSaveRecipientForPolluterAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();     
        $this->polluter = new DomoprimePollutingCompany($request->getPostParameter('Polluter')); // new object       
        if ($this->polluter->isNotLoaded() || !$request->getPostParameter('RecipientForPolluter'))
            return ;
        $this->form = new CustomerContractRecipientForPolluterViewForm($request->getPostParameter('RecipientForPolluter')); 
        $this->item=new DomoprimePolluterRecipient($this->polluter);      
        $this->form->bind($request->getPostParameter('RecipientForPolluter'));
        if ($this->form->isValid())
        {          
             if ($this->form->getValue('recipient_id'))
             {
                 $this->item->add(array('polluter_id'=>$this->polluter,
                                        'recipient_id'=>$this->form->getValue('recipient_id')));
                $this->item->save();   
             }    
             else
             {    
                 $this->item->delete();
             }    
             $messages->addInfo(__('Recipient has been updated.'));  
             $this->forward('app_domoprime','ajaxListPollutingCompany');             
        }   
        else
        {
              $messages->addError(__('Form has some errors.'));
             $this->item->add($this->form->getDefaults());
        }    
    }
    
}

