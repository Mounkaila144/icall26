<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsLeadsImportFormatFileForm.class.php";
require_once dirname(__FILE__)."/../locales/Imports/Forms/MarketingLeadsWpFormsAllLeadsImportForm.class.php";

class marketing_leads_ajaxReadFormatAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();                     
        $this->form=new MarketingLeadsWpFormsLeadsImportFormatFileForm($request->getPostParameter('WpFormsLeadsImportFormat'));
        $this->form->bind($request->getPostParameter('WpFormsLeadsImportFormat'),$request->getFiles('WpFormsLeadsImportFormat'));
        if ($this->form->isValid())
        {
            $file=$this->form['file']->getValue()->getTempName();           
            $import=new CsvImport($file);
            $this->header=$import->getHeader();
            $form=new MarketingLeadsWpFormsAllLeadsImportForm($this->getUser());              
            $this->fields=$form->getFieldsI18n();            
        }   
        else
        {
            $messages->addError(__("Form has some errors"));
//            echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
            $this->forward('marketing_leads_imports', 'ajaxNewFormatFromFile');
        }    
    }
}


