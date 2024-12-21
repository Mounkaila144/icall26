<?php

class customers_meetings_imports_google_sheet_ajaxUpdateNumberOfLinesAction extends mfAction
{
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        try {
            $id = (new mfValidatorInteger())->isValid($request->getPostParameter('CustomerMeetingImportGoogleSheetFormat'));
            $item = new CustomerMeetingImportGoogleSheetFormat($id);

            if ($item->isLoaded()) {
                $api = new UtilsGoogleSheetApi();
                $number = $api->getTotalRows($item->get('file_id'), $item->get('leaf_name'));
                $currentLines = $item->get('number_of_lines');

                if ($currentLines < $number) {
                    $status = $item->get('processed_rows') == 0 ? 0 : 1;
                    $item->add(['number_of_lines' => $number, 'status' => $status])->save();

                    return [
                        "action" => "updateLinesCustomerMeetingImportGoogleSheetFormat",
                        "restant" => $number - $currentLines,
                        "info" => __("Format Lines has been updated."),
                        "value" => $number,
                        "id" => $id,
                        "status" => $status
                    ];
                }
                return ["action" => "error", "error" => __("Aucune augmentation détectée.")];
            }
        } catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error') ? ["error" => $messages->getDecodedErrors()] : [];
    }
}
