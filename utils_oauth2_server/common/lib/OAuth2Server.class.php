<?php
require_once __DIR__ . "/../../common/vendor/autoload.php";

use OAuth2\Server;
use OAuth2\GrantType\AuthorizationCode;
use OAuth2\GrantType\RefreshToken;

class OAuth2Server
{
    protected $server;

    public function __construct($storage)
    {
        // Créer le serveur OAuth2 avec les stockages
        $this->server = new Server($storage);

        // Ajouter les types de grants que vous souhaitez prendre en charge
        $this->server->addGrantType(new AuthorizationCode($storage['authorization_code']));
        $this->server->addGrantType(new RefreshToken($storage['refresh_token']));
    }

    public function getServer()
    {
        return $this->server;
    }
}