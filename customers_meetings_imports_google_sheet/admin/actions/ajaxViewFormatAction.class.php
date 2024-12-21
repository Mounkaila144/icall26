<?php
require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingImportGoogleSheetFormatViewForm.class.php";

class customers_meetings_imports_google_sheet_ajaxViewFormatAction extends mfAction {
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $this->format=new CustomerMeetingImportGoogleSheetFormat($request->getPostParameter('CustomerMeetingImportGoogleSheetFormat'));
        if ($this->format->isNotLoaded())
        {
            $messages->addError(__('Format is invalid'));
            $this->forward('customers_meetings_imports_google_sheet','ajaxListPartialFormat');
        }
        $this->form=new CustomerMeetingImportGoogleSheetFormatViewForm(array('fields'=>$this->format->getNamesValues()));



    }

}
