<?php

// http://www.ecosol26.net/admin/module/site/products/item/admin/ImportItem
require_once dirname(__FILE__)."/../locales/Import/ProductItemImport.class.php";

class products_items_ajaxImportItemAction extends mfAction {
    
            
    function execute(mfWebRequest $request) 
    {   
      
        $messages = mfMessages::getInstance();              
        try
        {                         
          /*  $import=new ProductItemImport(__DIR__."/../data/import/items.csv",'csv');     
            $import->execute();               
            
           die(__METHOD__);*/
            $this->form=new ProductItemImportFileForm($request->getPostParameter('Import'));      
            if ($request->isMethod('POST') && ($request->getPostParameter('Import') || $request->getFiles('Import')))
            {                
                $this->form->bind($request->getPostParameter('Import'),$request->getFiles('Import'));
                if ($this->form->isValid())
                {                                                                             
                    $import=new ProductItemImport($this->form->getFile(),'zip',$this->site);     
                   $import->execute();
                   $messages->mergeMessages($import->getMessages()); 
                   $messages->addInfo(__("%s items have been created.",$import->getObjectInserted()));
                   $messages->addInfo(__("%s items have been updated.",$import->getObjectUpdated()));           
                   $messages->addInfo(__('File has been imported.'));
                   $this->forward('products_items','ajaxListPartialItem');
                }                                     
            }          
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
