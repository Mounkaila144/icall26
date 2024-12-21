<?php

class utils_google_sheet_ajaxLogoutAction extends mfAction
{
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        try
        {
            $settings = new UtilsGoogleSheetSettings();
            if ($settings->isLoaded())
            {
                $settings->logout();
                $response = array("action"=>"Logout","info"=>__("Google Account has been logout."));
            }
        }
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

