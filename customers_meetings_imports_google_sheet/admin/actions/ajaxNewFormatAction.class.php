<?php
require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingImportGoogleSheetFormatForm.class.php";
class customers_meetings_imports_google_sheet_ajaxNewFormatAction extends mfAction
{
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $this->item = new CustomerMeetingImportGoogleSheetFormat();
        $this->form = new CustomerMeetingImportGoogleSheetFormatForm($request->getPostParameter('Format'));
        if ($request->getPostParameter('Format')) {
            try {
                $this->form->bind($request->getPostParameter('Format'));
                if ($this->form->isValid()) {
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist()) {throw new mfException(__('Format already exists'));}
                    $this->item->setFieldsValues($this->form->getFieldsValues());
                    $this->item->set('number_of_lines',$this->form->getApi()->getTotalRows($this->form->getValue('file_id'),$this->form->getValue('leaf_name')));
                    $this->item->save();
                    $messages->addInfo(__("Format has been created.", $this->item->get('name')));
                    $this->forward('customers_meetings_imports_google_sheet', 'ajaxListPartialFormat');
                } else {
                    $messages->addError(__("Form has some errors"));
                    $messages->addError(implode("<br/>",$this->form->getErrorSchema()->getNamedErrorMessage('missings')));
                    $messages->addError(implode("<br/>",$this->form->getErrorSchema()->getNamedErrorMessage('doubles')));
                    $this->item->add($request->getPostParameter('Format'));
                }
            } catch (mfException $e) {
                $messages->addError($e);
            }
        }
    }
}






