<?php

class services_zapier_refreshAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $oauthServer = new ServicesZapierServer();
        $server = $oauthServer->getServer();

        $oauthRequest = OAuth2Request::createFromGlobals(); // Important : utiliser createFromGlobals() pour gérer les requêtes POST
        $oauthResponse = $server->handleTokenRequest($oauthRequest);

        $oauthResponse->send();
        exit;
    }
}