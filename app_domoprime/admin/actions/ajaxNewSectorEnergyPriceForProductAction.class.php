<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSectorEnergyPriceForProductNewForm.class.php";

class app_domoprime_ajaxNewSectorEnergyPriceForProductAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();          
         $this->product=$request->getRequestParameter('product',new Product($request->getPostParameter('Product')));
        if ($this->product->isNotLoaded())
            return ;
        $this->form= new DomoprimeSectorEnergyPriceForProductNewForm($request->getPostParameter('DomoprimeSectorEnergyProduct'));
        $this->item=new DomoprimeProductSectorEnergy(); 
        if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeSectorEnergyProduct'))
            return ;
        $this->form->bind($request->getPostParameter('DomoprimeSectorEnergyProduct'));
        try
        {
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                $this->item->set('product_id',$this->product);
                if ($this->item->isExist())
                    throw new mfException(__('Price already exists.'));
                $this->item->save();
                $messages->addInfo(__('Price has been created.'));
                $request->addRequestParameter('product', $this->product);
                $this->forward('app_domoprime','ajaxListPartialSectorEnergyForProduct');
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
