<?php

use OAuth2\Storage\ClientCredentialsInterface;
use OAuth2\Storage\ClientInterface;

abstract class OAuth2ClientStorage implements ClientInterface, ClientCredentialsInterface
{
    public function getClientScope($client_id)
    {
        // Implémentation par défaut ou laisser vide
        return null; // Aucun scope par défaut
    }

    public function isPublicClient($client_id)
    {
        // Implémentation par défaut ou laisser vide
        return false; // Par défaut, les clients ne sont pas publics
    }

    // Les méthodes suivantes sont abstraites et doivent être implémentées par les classes qui héritent de cette classe
    abstract public function getClientDetails($client_id);
    abstract public function checkRestrictedGrantType($client_id, $grant_type);
    abstract public function checkClientCredentials($client_id, $client_secret = null);
}



