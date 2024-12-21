<?php

class customers_meetings_imports_google_sheet_ajaxResetAction extends mfAction
{
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        try {
            $id = (new mfValidatorInteger())->isValid($request->getPostParameter('CustomerMeetingImportGoogleSheetFormat'));
            $item = new CustomerMeetingImportGoogleSheetFormat($id);
            $api = new UtilsGoogleSheetApi();
            $total = $api->getTotalRows($item->get('file_id'), $item->get('leaf_name'));
            if ($item->isLoaded()) {
                $item->add(['status' => 0,'processed_rows' => 0,'success_count' => 0,'error_count' => 0,'last_offset' => 0,'number_of_lines' => $total])->save();
                $item->deleteLog();
                return [
                    "action" => "Reset",
                    "info" => __("Format has been Reset"),
                    "id" => $id,
                    "value" => $total,
                ];
            }
        } catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error') ? ["error" => $messages->getDecodedErrors()] : [];
    }
}
