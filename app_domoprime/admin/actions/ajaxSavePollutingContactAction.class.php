<?php

require_once dirname(__FILE__).'/../locales/Forms/CustomerContractPollutingContactViewForm.class.php';

class app_domoprime_ajaxSavePollutingContactAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();     
        $this->item = new PartnerPolluterContact($request->getPostParameter('PollutingContact')); // new object       
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Contact is invalid.'));
            $this->forward ('app_domoprime','ajaxListPartialPollutingCompany');
        }
        $this->form = new CustomerContractPollutingContactViewForm($request->getPostParameter('PollutingContact'));  
        try
        {           
            $this->form->bind($request->getPostParameter('PollutingContact'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Contact already exists."));
                $this->item->save();
                $messages->addInfo(__("Contact [%s] has been saved.",(string)$this->item));  
                $request->addRequestParameter('DomoprimePolluting', $this->item->getCompany());
                $this->forward("app_domoprime","ajaxListPollutingContact");
            }    
            else
            {
                 $messages->addError(__("Form has some errors."));   
                 $this->item->add($request->getPostParameter('PollutingContact')); // repopulate        
            }                  
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }
}
