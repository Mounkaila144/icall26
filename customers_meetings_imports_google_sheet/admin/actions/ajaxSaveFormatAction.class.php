<?php
require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingImportGoogleSheetFormatViewForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingImportGoogleSheetFormatViewForm.class.php";

class customers_meetings_imports_google_sheet_ajaxSaveFormatAction extends mfAction {

    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                      
        try
        {
            $this->format=new CustomerMeetingImportGoogleSheetFormat($request->getParameter('CustomerMeetingImportGoogleSheetFormat'));
            if ($this->format->isNotLoaded())
            {
                $messages->addError(__('Format is invalid'));
                $this->forward('customers_meetings_imports_google_sheet','ajaxListPartialFormat');
            }
            $this->form= new CustomerMeetingImportGoogleSheetFormatViewForm($request->getPostParameter('CustomerMeetingImportGoogleSheetFormat'));
            $this->form->bind($request->getPostParameter('CustomerMeetingImportGoogleSheetFormat'));
            if ($this->form->isValid())
            {
                $this->format->add($this->form->getValues());
                $this->format->setFieldsValues($this->form->getFieldsValues());
                $this->format->save();
                $messages->addInfo(__("Format has been updated."));
                $this->forward('customers_meetings_imports_google_sheet','ajaxListPartialFormat');
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
