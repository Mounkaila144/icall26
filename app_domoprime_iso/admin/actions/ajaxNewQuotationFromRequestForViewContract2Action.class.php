<?php



class app_domoprime_iso_ajaxNewQuotationFromRequestForViewContract2Action extends mfAction
{
    
       
     function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));
        if ($this->contract->isLoaded())
        {          
            try
            {
                $this->quotation=new DomoprimeQuotation();      
                $this->quotation->createFromItemsAndContract($this->contract,$this->getUser()->getGuardUser());
                $this->getEventDispather()->notify(new mfEvent($this->quotation, 'app_domoprime.iso.contract.quotation.create'));     
                $messages->addInfo(__('Quotation has been created'));
            }
            catch (mfException $e)
            {
                $messages->addError($e);
            }
        }
        $request->addRequestParameter('contract', $this->contract);
        $request->addRequestParameter('is_from_new', true);
        $this->forward($this->getModuleName(), 'ajaxListPartialQuotationFromRequestForViewContract');            
    }
        
    

}
