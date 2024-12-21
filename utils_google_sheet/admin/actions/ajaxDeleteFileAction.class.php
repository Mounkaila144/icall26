<?php
require_once __DIR__. "/../locales/Forms/UtilsGoogleSheetSettingsForm.class.php";

class utils_google_sheet_ajaxDeleteFileAction extends mfAction
{

    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $response = array("action"=>"DeleteConfig");
        try {
            $settings=new UtilsGoogleSheetSettings();
            $settings->set('google_oauth_configs','')->save();
            $response["info"]=__("Config has been Deleted.");

        } catch (mfException $e) {
            $messages->addError($e);
        }

        return $messages->hasErrors() ? array("error" => $messages->getDecodedErrors()) : $response;
    }
}
