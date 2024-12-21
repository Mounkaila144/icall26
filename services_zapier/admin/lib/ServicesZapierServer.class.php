<?php

class ServicesZapierServer extends OAuth2Server
{
    public function __construct()
    {
        // Initialiser les stockages nécessaires
        $clientStorage = new ClientStorage();

        $storage = array(
            'client'              => $clientStorage,
            'client_credentials'  => $clientStorage, // Stockage client_credentials
            'authorization_code'  => new AuthCodeStorage(),
            'access_token'        => new AccessTokenStorage(),
            'refresh_token'       => new RefreshTokenStorage(),
            'scope'               => new ScopeStorage(),
        );

        // Appeler le constructeur parent avec le stockage configuré
        parent::__construct($storage);
    }
}
