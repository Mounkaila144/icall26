<?php

require_once dirname(__FILE__)."/../locales/Forms/TaxCollectionNewForm.class.php";
 
 
class products_ajaxNewTaxesAction extends mfAction {

     
     
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();     
        try 
        {
            $this->form = new TaxCollectionNewForm($request->getPostParameter('Taxes'));   
            if ($request->isMethod('POST') && $request->getPostParameter('Taxes'))
            {
                try 
                {                 
                    $this->form->bind($request->getPostParameter('Taxes'));                           
                    if ($this->form->isValid()) 
                    {                      
                        $this->collection = new TaxCollection($this->form['collection']->getValues());                     
                        $this->collection->save();                      
                        $messages->addInfo(__("Taxes have been saved."));
                        $this->forward('products','ajaxListPartialTaxes');
                    }
                    else
                    {            
                        $messages->addErrors(__("Form has errors."));                        
                    }                  
                } 
                catch (mfException $e)
                {
                   $messages->addError($e);
                }   
            }    
                 
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }     
        
    }

}