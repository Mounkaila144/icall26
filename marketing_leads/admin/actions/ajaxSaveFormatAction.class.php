<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsLeadsImportFormatFileForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsLeadsImportViewFormatForm.class.php";
require_once dirname(__FILE__)."/../locales/Imports/MarketingLeadsWpFormsAllLeadsImport.class.php";

class marketing_leads_ajaxSaveFormatAction extends mfAction {
    
       
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();    
        try
        {
            $this->format=new MarketingLeadsWpFormsLeadsImportFormat($request->getPostParameter('WpFormsLeadsImportReadFormat'));
            if ($this->format->isNotLoaded())
            {
                $messages->addError(__('Format is invalid'));
                $this->forward('marketing_leads','ajaxListPartialFormat');
            }
            $this->form=new MarketingLeadsWpFormsLeadsImportViewFormatForm($this->getUser(),$request->getPostParameter('WpFormsLeadsImportReadFormat'));
            $this->form->bind($request->getPostParameter('WpFormsLeadsImportReadFormat'));          
            if ($this->form->isValid())
            {                              
                $this->format->setFieldsValues($this->form->getFieldsValues());
                $this->format->save();
                $messages->addInfo(__("Format has been updated."));
                $this->forward('marketing_leads','ajaxListPartialFormat');
            }   
            else
            {
                $messages->addError(__("Form has some errors"));
                $messages->addError(implode("<br/>",$this->form->getErrorSchema()->getNamedErrorMessage('missings')));
                $messages->addError(implode("<br/>",$this->form->getErrorSchema()->getNamedErrorMessage('doubles')));
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }
    
}


