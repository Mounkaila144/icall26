<?php

class utils_google_sheet_ajaxGetSheetAction extends mfAction{
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        try {

            $api = new UtilsGoogleSheetApi();
            $response = $api->getSheetMetadata($request->getPostParameter('file'));
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
