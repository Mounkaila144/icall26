<?php



class services_zapier_tokenAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $oauthServer = new ServicesZapierServer();
        $server = $oauthServer->getServer();

        $oauthRequest = OAuth2Request::createFromGlobals();
        $oauthResponse = $server->handleTokenRequest($oauthRequest);

        $oauthResponse->send();
        exit;
    }
}
