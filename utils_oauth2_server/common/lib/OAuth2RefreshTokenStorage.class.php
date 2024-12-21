<?php
use OAuth2\Storage\RefreshTokenInterface;

class OAuth2RefreshTokenStorage implements RefreshTokenInterface
{
    public function getRefreshToken($refresh_token)
    {

        return false;

    }

    public function setRefreshToken($refresh_token, $client_id, $user_id, $expires, $scope = null)
    {

        return null;

    }


    public function unsetRefreshToken($refresh_token)
    {

    }
}