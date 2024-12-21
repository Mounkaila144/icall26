<?php

require_once dirname(__FILE__)."/../locales/Import/Contract/ContractImport.class.php";


class customers_contracts_ajaxImportContractAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
            
    function execute(mfWebRequest $request) 
    {   
        if (!$request->isXmlHttpRequest() )  
        {
                if ($request->getPostParameter('iFrame')=='true') // Comes from Iframe
                       $request->forceXMLRequest();                  
        }  
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);                
        try
        {              
            $this->form=new ContractImportFileForm($request->getPostParameter('Import'),$this->site);      
           // $import=new ProductsImport(dirname(__FILE__)."/../data/import/import1/products.csv",'csv',$site);     
           // $import->execute();               
           // $messages->mergeMessages($import->getMessages()); 
           
            if ($request->isMethod('POST') && ($request->getPostParameter('Import') || $request->getFiles('Import')))
            {                
                $this->form->bind($request->getPostParameter('Import'),$request->getFiles('Import'));
                if ($this->form->isValid())
                {                                                                             
                   $import=new ContractImport($this->form->getFile(),'zip',$this->site);     
                   $import->execute();
                   $messages->mergeMessages($import->getMessages()); 
                   $messages->addInfo(__("%s contract have been created.",$import->getObjectInserted()));
                   $messages->addInfo(__("%s contract have been updated.",$import->getObjectUpdated()));                   
                   $messages->addInfo(__('File has been imported.'));
                   $this->forward('customers_contracts','ajaxListPartialContract');
                }                                     
            }          
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
