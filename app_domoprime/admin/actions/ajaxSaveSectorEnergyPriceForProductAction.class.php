<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSectorEnergyPriceForProductForm.class.php";

class app_domoprime_ajaxSaveSectorEnergyPriceForProductAction extends mfAction {
    
                  
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                  
        $this->form= new DomoprimeSectorEnergyPriceForProductForm();
        $this->item=new DomoprimeProductSectorEnergy($request->getPostParameter('DomoprimeSectorEnergyProduct'));    
        if ($this->item->isNotLoaded() || !$request->isMethod('POST') || !$request->getPostParameter('DomoprimeSectorEnergyProduct'))
            return ;
        $this->form->bind($request->getPostParameter('DomoprimeSectorEnergyProduct'));
        try
        {                
            $this->form->bind($request->getPostParameter('DomoprimeSectorEnergyProduct'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());               
                if ($this->item->isExist())
                    throw new mfException(__('Price already exists.'));
                $this->item->save();
                $messages->addInfo(__('Price has been updated.'));
                $request->addRequestParameter('product', $this->item->getProduct());
                $this->forward('app_domoprime','ajaxListPartialSectorEnergyForProduct');
            }   
            else
            {               
                // Repopulate
              //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
                $this->item->add($this->form->getDefaults());
                $messages->addError(__("Form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
