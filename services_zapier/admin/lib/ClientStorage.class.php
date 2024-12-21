<?php

class ClientStorage extends OAuth2ClientStorage
{
    public function getClientDetails($client_id)
    {
        $client = new ServicesZapierClient();
        $client->loadByClientId($client_id);
        if ($client->isLoaded()) {
            return [
                'client_id'     => $client->get('client_id'),
                'client_secret' => $client->get('client_secret'),
                'redirect_uri'  => $client->get('redirect_uri'),
                'grant_types'   => $client->get('grant_types'),
                'scope'         => $client->get('scope'),
                'user_id'       => $client->get('user_id'),
            ];
        }
        return false;
    }

    public function checkRestrictedGrantType($client_id, $grant_type)
    {
        $clientDetails = $this->getClientDetails($client_id);
        if (isset($clientDetails['grant_types'])) {
            $grantTypes = explode(' ', $clientDetails['grant_types']);
            return in_array($grant_type, $grantTypes);
        }
        // Par défaut, autoriser tous les types de grants
        return true;
    }

    public function checkClientCredentials($client_id, $client_secret = null)
    {
        $client = new ServicesZapierClient();
        $client->loadByClientId($client_id);
        if ($client->isLoaded()) {
            return $client->get('client_secret') === $client_secret;
        }
        return false;
    }
}