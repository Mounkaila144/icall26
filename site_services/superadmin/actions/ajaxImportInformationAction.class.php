<?php

 require_once __DIR__."/../locales/Forms/ImportInformationFileForm.class.php";
require_once __DIR__."/../locales/Import/ImportInformationProcess.class.php";

 
class site_services_ajaxImportInformationAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {         
        $messages= mfMessages::getInstance();
         $this->form=new ImportInformationFileForm($request->getPostParameter('ImportInformation'));  
      if (!$request->getPostParameter('ImportInformation'))
          return ;
      try
      {
            $this->form->bind($request->getPostParameter('ImportInformation'),$request->getFiles('ImportInformation'));
            if ($this->form->isValid())
            {
                $csv= new ImportInformationProcess($this->form->getFile());
                $csv->process();
                $messages->addInfo(__('Information have been imported.'));                
                $this->forward($this->getModuleName(),"ajaxListPartialSiteServices");
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

