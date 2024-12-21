<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualProductNewForm.class.php";

class app_mutual_ajaxNewMutualProductAction extends mfAction {
    
    function execute(mfWebRequest $request) {          
        
        $messages = mfMessages::getInstance();     
        $this->partner = new MutualPartner($request->getPostParameter('MutualPartner'));
        
        if ($this->partner->isNotLoaded())
        {
            $messages->addError(__('Mutual is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualPartner');
        } 
        
        $this->item = new MutualProduct();
        $this->item->set('financial_partner_id',$this->partner);
        $this->form = new MutualProductNewForm();   
        
        try
        {
            if (!$request->isMethod('POST') || !$request->getPostParameter('MutualProduct'))
                return;
            
            $this->form->bind($request->getPostParameter('MutualProduct'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Product already exists."));
                $this->item->save();
                $messages->addInfo(__("Product [%s] has been saved",(string)$this->item));                   
                $this->forward("app_mutual","ajaxListPartialMutualProduct");
            }    
            else
            {
                $messages->addError(__("Form has some errors."));   
                $this->item->add($request->getPostParameter('MutualProduct'));       
            }     
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
