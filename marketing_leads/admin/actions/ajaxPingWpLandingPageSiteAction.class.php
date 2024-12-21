<?php


class marketing_leads_ajaxPingWpLandingPageSiteAction extends mfAction {

    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        try
        {
            $validator=new mfValidatorInteger();
            $item = new MarketingLeadsWpLandingPageSite($validator->isValid($request->getPostParameter('WpLandingPageSite')),null);
            if ($item->isLoaded())
            {
                $item->connect();
                $response = array("action"=>"ConnectServer",
                                "id" => $item->get('id'),
                                "info"=>__("Connection to server [%s] has been established.",$item->get('host_site')));
            }
        }
        catch (mfDatabaseException $e)
        {
            $messages->addError(__('Connection cannot be established.'));
        }
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
    

}

