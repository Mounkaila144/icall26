<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualProductDecommissionViewForm.class.php";

class app_mutual_ajaxSaveMutualProductDecommissionAction extends mfAction { 
     
    function execute(mfWebRequest $request) { 
        
        $messages = mfMessages::getInstance();   
        $this->item = new MutualProductDecommission($request->getPostParameter('MutualProductDecommission'));      
                
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Decommission is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualProductDecommission');
        }
        
        $this->form = new MutualProductDecommissionViewForm($request->getPostParameter('MutualProductDecommission'));  
        try
        {           
            $this->form->bind($request->getPostParameter('MutualProductDecommission'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                
                if ($this->item->isExist())
                    throw new mfException(__("Decommission already exists."));
                
                $this->item->save();
                $messages->addInfo(__("Decommission [%s] has been saved.",(string)$this->item));  
                $request->addRequestParameter('product', $this->item->getMutualProduct());
                $this->forward("app_mutual","ajaxListMutualProductDecommission");
            }    
            else
            {
                $messages->addError(__("Form has some errors."));   
                $this->item->add($request->getPostParameter('MutualProductDecommission')); 
            }                  
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
