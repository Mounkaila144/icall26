<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualProductCommissionViewForm.class.php";

class app_mutual_ajaxSaveMutualProductCommissionAction extends mfAction { 
     
    function execute(mfWebRequest $request) { 
        
        $messages = mfMessages::getInstance();   
        $this->item = new MutualProductCommission($request->getPostParameter('MutualProductCommission')); 
                
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Commission is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualProductCommission');
        }
        
        $this->form = new MutualProductCommissionViewForm($request->getPostParameter('MutualProductCommission'));  
        try
        {           
            $this->form->bind($request->getPostParameter('MutualProductCommission'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                
                if ($this->item->isExist())
                    throw new mfException(__("Commission already exists."));
                
                $this->item->save();
                $messages->addInfo(__("Commission [%s] has been saved.",(string)$this->item));  
                $request->addRequestParameter('product', $this->item->getMutualProduct());
                $this->forward("app_mutual","ajaxListMutualProductCommission");
            }    
            else
            {
                $messages->addError(__("Form has some errors."));   
                $this->item->add($request->getPostParameter('MutualProductCommission'));       
            }                  
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
