<?php
require_once dirname(__FILE__)."/../locales/Forms/CustomerContractZoneNewForm.class.php";

class customers_contracts_ajaxNewZoneAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();  
        $this->user=$this->getUser();
        try
        {
            $this->item=new CustomerContractZone();
            $this->form=new CustomerContractZoneNewForm($request->getPostParameter('CustomerContractZone')); 
            if ($request->isMethod('POST') && $request->getPostParameter('CustomerContractZone'))
            {           
                $this->form->bind($request->getPostParameter('CustomerContractZone'));
                if ($this->form->isValid())
                {                    
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist())
                        throw new mfException(__("Zone already exists."));  
                    $this->item->save();
                    $messages->addInfo(__("Zone has been created."));
                    $this->forward('customers_contracts', 'ajaxListZone');
                }   
                else
                {
                     $messages->addError(__("Form has some errors."));
                     $this->item->add($this->form->getDefaults());
                }    
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
    }

}
