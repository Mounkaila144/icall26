<?php

require_once dirname(__FILE__).'/../locales/Forms/CustomerContractZoneViewForm.class.php';

class customers_contracts_ajaxSaveZoneAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        $this->user=$this->getUser();
        $this->item=new CustomerContractZone($request->getPostParameter('CustomerContractZone'));    
        $this->form=new  CustomerContractZoneViewForm($request->getPostParameter('CustomerContractZone'));
        if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerContractZone') || $this->item->isNotLoaded())
            return ;
        $this->form->bind($request->getPostParameter('CustomerContractZone'));
        try
        {
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Zone already exists."));                                 
                $this->item->save();               
                $messages->addInfo(__("Zone has been updated."));                
                $this->forward('customers_contracts','ajaxListPartialZone');
            }   
            else
            {
                $messages->addError(__("Form has some errors."));
                $this->item->add($this->form->getDefaults());
                //var_dump($this->form->getErrorSchema()->getErrorsMessage());
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
    }

}
