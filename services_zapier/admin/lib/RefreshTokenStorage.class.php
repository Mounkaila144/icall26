<?php
use OAuth2\Storage\RefreshTokenInterface;

class RefreshTokenStorage extends OAuth2RefreshTokenStorage
{
    public function getRefreshToken($refresh_token)
    {
        $refreshToken = new ServicesZapierRefreshToken($refresh_token); // A adapter à votre model Refresh Token

        if ($refreshToken->isLoaded()) {
            return [
                'refresh_token' => $refreshToken->get('refresh_token'),
                'client_id' => $refreshToken->get('client_id'),
                'user_id' => $refreshToken->get('user_id'),
                'expires' => strtotime($refreshToken->get('expires')),
                'scope' => $refreshToken->get('scope'),
            ];
        }

        return false;

    }

    public function setRefreshToken($refresh_token, $client_id, $user_id, $expires, $scope = null)
    {

        $refreshToken = new ServicesZapierRefreshToken();
        $refreshToken->add([
            'refresh_token' => $refresh_token,
            'client_id' => $client_id,
            'user_id' => $user_id,
            'expires' => date('Y-m-d H:i:s', $expires),
            'scope' => $scope,

        ]);
        $refreshToken->save();

    }


}