<?php

require_once dirname(__FILE__)."/../locales/Import/Status/MeetingStatusImport.class.php";


class customers_meetings_ajaxImportStatusAction extends mfAction {
    
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
            $this->form=new MeetingStatusImportFileForm($request->getPostParameter('Import'),$this->site);      
           // $import=new ProductsImport(dirname(__FILE__)."/../data/import/import1/products.csv",'csv',$site);     
           // $import->execute();               
           // $messages->mergeMessages($import->getMessages()); 
           
            if ($request->isMethod('POST') && ($request->getPostParameter('Import') || $request->getFiles('Import')))
            {                
                $this->form->bind($request->getPostParameter('Import'),$request->getFiles('Import'));
                if ($this->form->isValid())
                {                                                                             
                   $import=new MeetingStatusImport($this->form->getFile(),'zip',$this->site);     
                   $import->execute();
                   $messages->mergeMessages($import->getMessages()); 
                   $messages->addInfo(__("%s status have been created.",$import->getObjectInserted()));
                   $messages->addInfo(__("%s status have been updated.",$import->getObjectUpdated()));                   
                   $messages->addInfo(__('File has been imported.'));
                   $this->forward('customers_meetings','ajaxListPartialStatus');
                }                                     
            }          
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
