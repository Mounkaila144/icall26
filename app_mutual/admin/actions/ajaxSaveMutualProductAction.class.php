<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualProductViewForm.class.php";

class app_mutual_ajaxSaveMutualProductAction extends mfAction { 
     
    function execute(mfWebRequest $request) { 
        
        $messages = mfMessages::getInstance();
        $this->item = new MutualProduct($request->getPostParameter('MutualProduct')); 
                
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Product is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualProduct');
        }
        
        $this->form = new MutualProductViewForm($request->getPostParameter('MutualProduct'));  
        try
        {           
            $this->form->bind($request->getPostParameter('MutualProduct'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Product already exists."));
                $this->item->save();
                $messages->addInfo(__("Product [%s] has been saved.",(string)$this->item));  
                $request->addRequestParameter('mutual', $this->item->getMutualPartner());
                $this->forward("app_mutual","ajaxListMutualProduct");
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
