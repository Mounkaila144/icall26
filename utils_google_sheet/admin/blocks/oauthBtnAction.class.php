<?php

class utils_google_sheet_oauthBtnActionComponent extends mfActionComponent {
    function execute(mfWebRequest $request) {
        try {
            session_start();
            $settings = new UtilsGoogleSheetSettings();
            $client = new GoogleClient();
            $client->setAuthConfig($settings->getConfigs()->toArray());
            $client->addScope($settings->getScopes());
            $client->setRedirectUri($settings->getRedirectUri());
            $client->setAccessType('offline');
            $client->setPrompt('consent');

            $state= md5(uniqid(mt_rand(), true));

            $combinedState = $settings->getBasetUri() . '|' . $state;
            $client->setState($combinedState);
            $settings->set('session_' . session_id(), $state)->save();

            $this->auth_url = $client->createAuthUrl();
            $this->settings = $settings;
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
        }
    }
}
