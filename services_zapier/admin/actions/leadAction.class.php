<?php

class services_zapier_leadAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $oauthServer = new ServicesZapierServer();
        $server = $oauthServer->getServer();

        $oauthRequest = OAuth2Request::createFromGlobals();
        $oauthResponse = new OAuth2Response();

        // Vérification du token d'accès
        if (!$server->verifyResourceRequest($oauthRequest, $oauthResponse)) {
            $oauthResponse->send();
            exit;
        }

        return ['success' => true, 'data' => 'test'];
    }
}
