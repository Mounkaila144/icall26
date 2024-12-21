<?php

class utils_google_sheet_callbackAction extends mfActions {
    function execute(mfWebRequest $request) {
        try {
            $settings = new UtilsGoogleSheetSettings();
            $form= new UtilsGoogleSheetCodeForm();
            $form->bind($request->getGetParameters());

            if ($form->isValid())
            {

                if ($form->getValue('state') !== $settings->get('session_' . session_id()))
                    throw new mfException(__("Invalid state - potential CSRF attack."));

                $client = new GoogleClient();
                $client->setAuthConfig($settings->getConfigs()->toArray());
                $client->setRedirectUri($settings->getRedirectUri());
                $client->addScope([Google_Service_Sheets::SPREADSHEETS, Google_Service_Drive::DRIVE]);

                $token = $client->fetchAccessTokenWithAuthCode($form->getValue('code'));
                if (!empty($token['error'])) throw new Exception(__("Error during code exchange: ...") . $token['error_description']);


                $settings->set('access_token', $token['access_token'])
                    ->set('refresh_token', $token['refresh_token'])
                    ->set('expires_in', $token['expires_in'])
                    ->set('created_at', time())
                    ->set('session_' . session_id(), null)
                    ->save();

                $this->redirect(url());

            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
