<?php

class UtilsGoogleSheetSettings extends SiteSettings
{
    protected $configs = null;

    public function __call($name, $arguments)
    {
        if (preg_match('/^(get|set|has|remove)(.+)$/', $name, $matches)) {
            $action = $matches[1];
            $property = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $matches[2]));
            $propertyMethods = ['access_token', 'refresh_token', 'expires_in', 'redirect_uri', 'created_at'];
            $configMethods = ['client_id', 'client_secret'];
            if (in_array($property, $propertyMethods)) {
                if ($action === 'get') {
                    return $this->get($property);
                } elseif ($action === 'set') {
                    $this->set($property, $arguments[0]);
                    return $this;
                }
            }

            if (in_array($property, $configMethods)) {
                $configs = $this->getConfigs();
                return isset($configs['web'][$property]) ? $configs['web'][$property] : null;
            }
            if ($action === 'has' && isset($arguments[0])) {
                return $this->settings->has($arguments[0]);
            }
            if ($action === 'remove' && isset($arguments[0])) {
                $this->settings->remove($arguments[0]);
                return $this;
            }
        }
        throw new mfException("Method $name does not exist");
    }

    function getConfigs()
    {
        return $this->configs=$this->configs===null?new mfArray(json_decode($this->get('google_oauth_configs'),true)):$this->configs;
    }
    function getScopes()
    {
        return [
            'https://www.googleapis.com/auth/drive.readonly',
            'https://www.googleapis.com/auth/spreadsheets' // Accès complet requis pour batchGetByDataFilter
        ];
    }

    function checkFile()
    {
        return ($this->getConfigs() instanceof mfArray && !empty($this->getConfigs()->toArray()));
    }
    function getBasetUri()
    {
        return url_to('utils_google_sheet_callback', array(), 'admin', '');
    }

    public function logout()
    {
        foreach (['access_token', 'refresh_token', 'expires_in'] as $key) {
            $this->set($key, null);
        }
        $this->save();
    }

    function checkToken()
    {

        return !empty($this->getAccessToken());
    }

}
