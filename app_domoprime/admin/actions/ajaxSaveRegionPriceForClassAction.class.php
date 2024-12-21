<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeRegionPriceForClassForm.class.php";

class app_domoprime_ajaxSaveRegionPriceForClassAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                  
        $this->form= new DomoprimeRegionPriceForClassForm();
        $this->item=new DomoprimeClassRegionPrice($request->getPostParameter('DomoprimeRegionPriceClass'));      
        if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeRegionPriceClass'))
            return ;
        $this->form->bind($request->getPostParameter('DomoprimeRegionPriceClass'));
        try
        {
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());                
                if ($this->item->isExist())
                    throw new mfException(__('Price already exists.'));
                $this->item->save();
                $messages->addInfo(__('Price has been updated.'));  
                $request->addRequestParameter('class', $this->item->getClass());
                $this->forward('app_domoprime','ajaxListPartialRegionPriceForClass');
            }   
            else
            {
                $messages->addError(__('Form has some errors.'));
                $this->item->add($this->form->getDefaults());
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
