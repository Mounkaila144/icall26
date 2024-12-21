<?php

class AuthCodeStorage extends OAuth2CodeStorage
{
    public function getAuthorizationCode($code)
    {
        $authCode = new ServicesZapierAuthCode($code);

        if ($authCode->isLoaded()) {
            return array(
                'authorization_code' => $authCode->get('authorization_code'),
                'client_id'          => $authCode->get('client_id'),
                'user_id'            => $authCode->get('user_id'),
                'redirect_uri'       => $authCode->get('redirect_uri'),
                'expires'            => strtotime($authCode->get('expires')),
                'scope'              => $authCode->get('scope'),
            );
        }
        return false;
    }

    public function setAuthorizationCode($code, $client_id, $user_id, $redirect_uri, $expires, $scope = null)
    {

        $authCode = new ServicesZapierAuthCode();
        $authCode->add(array(
            'authorization_code' => $code,
            'client_id'          => $client_id,
            'user_id'            => $user_id,
            'redirect_uri'       => $redirect_uri,
            'expires'            => date('Y-m-d H:i:s', $expires),
            'scope'              => $scope,
        ));
        $authCode->save();

    }

    public function expireAuthorizationCode($code)
    {

        $authCode = new ServicesZapierAuthCode($code);
        if ($authCode->isLoaded()) {
            $authCode->delete();
        }
    }
}
