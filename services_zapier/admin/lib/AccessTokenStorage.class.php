<?php
use OAuth2\Storage\AccessTokenInterface;

class AccessTokenStorage extends OAuth2AccessTokenStorage
{
    public function getAccessToken($access_token)
    {
        $accessToken = new ServicesZapierAccessToken();
        $accessToken->loadByToken($access_token);
        if ($accessToken->isLoaded()) {
            return array(
                'access_token' => $accessToken->get('access_token'),
                'client_id'    => $accessToken->get('client_id'),
                'user_id'      => $accessToken->get('user_id'),
                'expires'      => strtotime($accessToken->get('expires')),
                'scope'        => $accessToken->get('scope'),
            );
        }
        return false;
    }

    public function setAccessToken($access_token, $client_id, $user_id, $expires, $scope = null)
    {
        $accessToken = new ServicesZapierAccessToken();
        $accessToken->add(array(
            'access_token' => $access_token,
            'client_id'    => $client_id,
            'user_id'      => $user_id,
            'expires'      => date('Y-m-d H:i:s', $expires),
            'scope'        => $scope,
        ));
        $accessToken->save();
    }
}
