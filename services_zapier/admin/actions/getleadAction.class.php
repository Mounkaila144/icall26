<?php

class services_zapier_getleadAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {


        // Récupération des paramètres GET et POST
        $parameters = $request->getGetAndPostParameters();

       return  array(
           'id' => isset($parameters['id']) ? $parameters['id'] : uniqid(), // Génération d'un ID unique si non fourni
           'first_name' => isset($parameters['first_name']) ? $parameters['first_name'] : null,
           'last_name' => isset($parameters['last_name']) ? $parameters['last_name'] : null,
           'email' => isset($parameters['email']) ? $parameters['email'] : null,
       );
    }
}

