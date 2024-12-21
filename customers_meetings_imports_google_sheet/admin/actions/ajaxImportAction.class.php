<?php
require_once __DIR__ ."/../locales/Forms/CustomerMeetingImportGoogleSheetFilterForm.class.php";
require_once __DIR__ . "/../locales/Imports/CustomerMeetingImportGoogleSheet.class.php";

class customers_meetings_imports_google_sheet_ajaxImportAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $response = [];

        $form = new CustomerMeetingImportGoogleSheetFilterForm();
        $form->bind($request->getPostParameter('format'));

            try {
                if ($form->isValid()) {
                $import = new CustomerMeetingImportGoogleSheet($form->getValue('format_id'), array('offset' => $form->getValue('offset')));
                $import->execute();
                    if ($import->isCompleted()) {
                        $import->getFormat()->add(['processed_rows' => $import->getFormat()->number_of_lines, 'status' => 2])->save();
                    }
                    $response = [
                        'infos' => $import->getInfo(),
                        'isCompleted' => $import->isCompleted(),
                        'processedRows' => $import->getProcessedRows(),
                        'totalProcessedRows' => $import->getFormat()->get('processed_rows'),
                        'totalSuccessCount' => $import->getFormat()->get('success_count'),
                        'totalErrorCount' => $import->getFormat()->get('error_count'),
                        'totalRows' => $import->getFormat()->number_of_lines,
                        //'remainingRows' => $import->getRemainingRows(),
                        //'tempInsertion' => $import->getTempInsertion(),
                        //'tempApi' => $import->getTempApi(),
                        'nextOffset' => $import->isCompleted() ? null : $import->getFormat()->get('last_offset'),
                    ];

                }else{
                    return ['error' => __('invalide offset or format')];
                }
            } catch (mfException $e) {
                $messages->addError($e);
            }

        return $messages->hasMessages('error') ? ['error' => $messages->getDecodedErrors()] : $response;


    }
}
