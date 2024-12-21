<?php
use OAuth2\Storage\AccessTokenInterface;

class OAuth2AccessTokenStorage implements AccessTokenInterface
{
    public function getAccessToken($access_token)
    {

        return false;
    }

    public function setAccessToken($access_token, $client_id, $user_id, $expires, $scope = null)
    {
        return null;
    }
}
