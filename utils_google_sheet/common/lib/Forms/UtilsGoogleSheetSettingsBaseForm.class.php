<?php

class UtilsGoogleSheetSettingsBaseForm extends mfForm
{
    protected $settings = null;

    function configure()
    {
        $this->settings = UtilsGoogleSheetSettings::load();
    }

    function getSettings()
    {
        return $this->settings;
    }


}


