<?php
use OAuth2\Storage\AuthorizationCodeInterface;

class OAuth2CodeStorage implements AuthorizationCodeInterface
{
    public function getAuthorizationCode($code)
    {

        return false;
    }

    public function setAuthorizationCode($code, $client_id, $user_id, $redirect_uri, $expires, $scope = null)
    {
        return null;

    }

    public function expireAuthorizationCode($code)
    {
        return null;
    }
}
