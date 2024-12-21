<?php

require_once __DIR__."/../locales/Forms/ImportUploadSiteTextForm.class.php";
require_once __DIR__."/../locales/Imports/ImportSiteTextFileProcess.class.php";

class site_text_ajaxImportTextAction extends mfAction {
    
       
    
       
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
         $this->user=$this->getUser();               
        try
      {
            $this->form= new ImportUploadSiteTextForm();
            if (!$request->getPostParameter('ImportSiteText'))
                return ;
            $this->form->bind($request->getPostParameter('ImportSiteText'),$request->getFiles('ImportSiteText'));
            if ($this->form->isValid())
            {                
                $csv= new ImportSiteTextFileProcess($this->form->getFile());
                $csv->process();
                $messages->addInfo(__('texts have been imported.'));                    
                $this->forward($this->getModuleName(),"ajaxListPartialText");
            }   
            else
            {
                $messages->addError(__('Form has some errors.'));
            } 
      }
      catch (mfException $e)
      {
         $messages->addError($e); 
      }
    }

}
