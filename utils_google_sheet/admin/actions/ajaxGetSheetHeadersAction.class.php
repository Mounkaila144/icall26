<?php

class utils_google_sheet_ajaxGetSheetHeadersAction extends mfAction {
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        try {
            $api = new UtilsGoogleSheetApi();
            $response = $api->getSheetHeaders($request->getPostParameter('file'), $request->getPostParameter('leaf'));
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;

    }
}

