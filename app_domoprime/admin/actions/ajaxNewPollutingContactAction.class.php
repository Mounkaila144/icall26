<?php

require_once dirname(__FILE__).'/../locales/Forms/CustomerContractPollutingContactNewForm.class.php';

class app_domoprime_ajaxNewpollutingContactAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();     
        $item = $request->getRequestParameter('Polluting',new PartnerPolluterCompany($request->getPostParameter('Polluting'))); // new object 
        if ($item->isNotLoaded())
        {
            $messages->addError(__('Polluting is invalid.'));
            $this->forward ('app_domoprime','ajaxListPartialPollutingCompany');
        }    
        $this->item = new PartnerPolluterContact(); // new object
        $this->item->set('company_id',$item);
        $this->form = new CustomerContractPollutingContactNewForm();    
        try
        {
            if ($request->isMethod('POST') && $request->getPostParameter('PollutingContract'))
            {
                $this->form->bind($request->getPostParameter('PollutingContract'));
                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist())
                        throw new mfException(__("Contact already exists."));
                    $this->item->save();
                    $messages->addInfo(__("Contact [%s] has been saved",(string)$this->item));  
                    $request->addRequestParameter('DomoprimePolluting',$item);
                    $this->forward("app_domoprime","ajaxListPollutingContact");
                }    
                else
                {
                     $messages->addError(__("Form has some errors."));   
                     $this->item->add($request->getPostParameter('PollutingContract')); // repopulate        
                }    
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }
}
