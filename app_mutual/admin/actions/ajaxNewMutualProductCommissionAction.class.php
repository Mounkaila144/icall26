<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualProductCommissionNewForm.class.php";

class app_mutual_ajaxNewMutualProductCommissionAction extends mfAction {
    
    function execute(mfWebRequest $request) {          
        
        $messages = mfMessages::getInstance();     
        $this->product = new MutualProduct($request->getPostParameter('MutualProduct')); // new object 
        
        if ($this->product->isNotLoaded())
        {
            $messages->addError(__('Mutual is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualPartner');
        } 
        
        $this->item = new MutualProductCommission(); // new object
        $this->item->set('mutual_product_id',$this->product);
        $this->form = new MutualProductCommissionNewForm();   
        
        try
        {
            if (!$request->isMethod('POST') || !$request->getPostParameter('MutualProductCommission'))
                return;
            
            $this->form->bind($request->getPostParameter('MutualProductCommission'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Commission already exists."));
                $this->item->save();
                $messages->addInfo(__("Commission [%s] has been saved",(string)$this->item));                   
                $this->forward("app_mutual","ajaxListPartialMutualProductCommission");
            }    
            else
            {
                $messages->addError(__("Form has some errors."));   
                $this->item->add($request->getPostParameter('MutualProductCommission')); // repopulate        
            }     
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
