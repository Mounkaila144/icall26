<?php
class customers_meetings_imports_google_sheet_ajaxGetImportStatusAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $response = [];
        $formatId = $request->getPostParameter('format')['format_id'];
        $format = new CustomerMeetingImportGoogleSheetFormat($formatId);
        try {
        if (!$format->isLoaded()) {
            return ['error' => __('ID de format invalide')];
        }

        $response = [
            'processedRows' => $format->get('processed_rows') ?: 0,
            'successCount' => $format->get('success_count') ?: 0,
            'errorCount' => $format->get('error_count') ?: 0,
            'nextOffset' => $format->get('last_offset') ?: 0,
            'totalRows' => $format->get('number_of_lines'),
        ];
        } catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error') ? ['error' => $messages->getDecodedErrors()] : $response;

    }
}
