<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualProductDecommissionNewForm.class.php";

class app_mutual_ajaxNewMutualProductDecommissionAction extends mfAction {
    
    function execute(mfWebRequest $request) {          
        
        $messages = mfMessages::getInstance();     
        $this->product = new MutualProduct($request->getPostParameter('MutualProduct')); // new object 
        
        if ($this->product->isNotLoaded())
        {
            $messages->addError(__('Mutual is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualPartner');
        } 
        
        $this->item = new MutualProductDecommission(); // new object
        $this->item->set('mutual_product_id',$this->product);
        $this->form = new MutualProductDecommissionNewForm();   
        
        try
        {
            if (!$request->isMethod('POST') || !$request->getPostParameter('MutualProductDecommission'))
                return;
            
            $this->form->bind($request->getPostParameter('MutualProductDecommission'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Decommission already exists."));
                $this->item->save();
                $messages->addInfo(__("Decommission [%s] has been saved",(string)$this->item));                   
                $this->forward("app_mutual","ajaxListPartialMutualProductDecommission");
            }    
            else
            {
                $messages->addError(__("Form has some errors."));   
                $this->item->add($request->getPostParameter('MutualProductDecommission')); // repopulate        
            }     
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
