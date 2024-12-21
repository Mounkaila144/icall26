<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsLeadsImportFormatFileForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsLeadsImportFormatForm.class.php";
require_once dirname(__FILE__)."/../locales/Imports/MarketingLeadsWpFormsAllLeadsImport.class.php";

class marketing_leads_ajaxSaveReadFormatAction extends mfAction {

    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();    
        try
        {
            $this->form=new MarketingLeadsWpFormsLeadsImportFormatForm($this->getUser(),$request->getPostParameter('WpFormsLeadsImportReadFormat'));          
            $this->form->bind($request->getPostParameter('WpFormsLeadsImportReadFormat'));         
            if ($this->form->isValid())
            {
                $format=new MarketingLeadsWpFormsLeadsImportFormat();
                $format->set('name',$this->form['name']->getValue());
                if ($format->isExist())
                    throw new mfException(__('Format already exists.'));
                // var_dump($this->form->getFieldsValues());
                $format->setFieldsValues($this->form->getFieldsValues());
                $format->save();
                $messages->addInfo(__("Format has been created."));
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


