<?php
// www.ecosol28.net/admin/module/site/customers/meeting/forms/admin/Import
require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormImportForm.class.php";
//require_once dirname(__FILE__)."/../locales/Imports/CustomerContractExportFormatImport.class.php";

class customers_meetings_forms_ajaxImportAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();       
        try
        {
         /*   $import = new  CustomerMeetingFormFileImport(new File(__DIR__."/../data/import.xml"));
            $import->execute();  die(__METHOD__); */
             $this->form=new CustomerMeetingFormImportForm($this->user);        
            if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerMeetingFormImport'))
                return ;
            $this->form->bind($request->getPostParameter('CustomerMeetingFormImport'),$request->getFiles('CustomerMeetingFormImport')); 
            if ($this->form->isValid())
            {             
                $import = new  CustomerMeetingFormFileImport($this->form->getFile());
                $import->execute(); 
                                                                                                                  
                $messages->addInfo(__('Form has been imported'));        
                $this->forward($this->getModuleName(),'ajaxListPartialForm');   
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


