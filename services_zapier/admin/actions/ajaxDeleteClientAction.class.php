<?php
class services_zapier_ajaxDeleteClientAction extends mfAction
{
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        try
        {
            $item=new mfValidatorString();
            $client_id=$item->isValid($request->getPostParameter('ServicesZapierClient'));
            $item= new ServicesZapierClient(['client_id' => $client_id]);
            if ($item->isLoaded())
            {
                $item->delete();
                $response = array("action"=>"deleteServicesZapierClient","id" =>$client_id,"info"=>__("Client [%s] has been deleted."));
            }
        }
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

