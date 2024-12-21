<?php

 require_once __DIR__."/../locales/Forms/ImportCompanyFileForm.class.php";
require_once __DIR__."/../locales/Imports/ImportCompanyProcess.class.php";

 
class site_ajaxImportCompanyAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {         
        $messages= mfMessages::getInstance();
         $this->form=new ImportCompanyFileForm($request->getPostParameter('ImportCompany'));  
      if (!$request->getPostParameter('ImportCompany'))
          return ;
      try
      {
            $this->form->bind($request->getPostParameter('ImportCompany'),$request->getFiles('ImportCompany'));
            if ($this->form->isValid())
            {
                $csv= new ImportCompanyProcess($this->form->getFile());
                $csv->process();
                $messages->addInfo(__('Companies have been imported.'));                
                $this->forward($this->getModuleName(),"ajaxListPartial");
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

