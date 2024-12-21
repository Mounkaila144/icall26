<?php
require_once dirname(__FILE__)."/../locales/Forms/ProductItemFormImportForm.class.php";

class products_items_ajaxImportXMLProductItemAction extends mfAction{
 
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();       
        try
        {
             $this->form=new ProductItemFormImportForm($this->user);        
            if (!$request->isMethod('POST') || !$request->getPostParameter('ProductItemFormImport'))
                return ;
            $this->form->bind($request->getPostParameter('ProductItemFormImport'),$request->getFiles('ProductItemFormImport')); 
            if ($this->form->isValid())
            {             
                $import = new  ProductItemFormFileImport($this->form->getFile());
                $import->execute(); 
                                                                                                                  
                $messages->addInfo(__('Form has been imported'));        
                $this->forward($this->getModuleName(),'ajaxListPartialItem');   
            }   
            else
            {
                $messages->addError(__("Form has some errors")); 
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);  
        }       
    }
}
