<?php
class customers_meetings_imports_google_sheet_ajaxDeleteFormatAction extends mfAction
{
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        try
        {
            $item=new mfValidatorInteger();
            $id=$item->isValid($request->getPostParameter('CustomerMeetingImportGoogleSheetFormat'));
            $item= new CustomerMeetingImportGoogleSheetFormat($id);
            if ($item->isLoaded())
            {
                $item->delete();
                $response = array("action"=>"deleteCustomerMeetingImportGoogleSheetFormat","id" =>$id,"info"=>__("Format [%s] has been deleted.",$item->get('meta_title')));
            }
        }
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

