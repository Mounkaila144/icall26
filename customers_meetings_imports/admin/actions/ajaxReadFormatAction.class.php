<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormatFileForm.class.php";
require_once dirname(__FILE__)."/../locales/Imports/Forms/CustomerMeetingImportForm.class.php";

class customers_meetings_imports_ajaxReadFormatAction extends mfAction {
    
       
    
    function execute(mfWebRequest $request)
    {       
        $messages = mfMessages::getInstance();                     
        $this->form=new CustomerMeetingFormatFileForm($request->getPostParameter('CustomerMeetingFormat'));
        $this->form->bind($request->getPostParameter('CustomerMeetingFormat'),$request->getFiles('CustomerMeetingFormat'));
        if ($this->form->isValid())
        {
            $file=new File($this->form['file']->getValue()->getTempName());           
            $import=new CsvImport($file);
            
             $this->header=$import->getHeader();
              
            $form=new CustomerMeetingImportForm($this->getUser());     
            $this->fields=$form->getFieldsI18n(); 
             
           var_dump($this->header);
        }   
        else
        {            
            $messages->addError(__("Form has some errors"));
           // var_dump($this->form->getErrorSchema()->getErrorsMessage());
            $request->addRequestParameter('form', $this->form);
            $this->forward('customers_meetings_imports', 'ajaxNewFormatFromFile');
        }    
    }
}


