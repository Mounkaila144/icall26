<?php
class UtilsGoogleSheetSettingsForm extends UtilsGoogleSheetSettingsBaseForm
{
    function configure() {
        $this->setValidators([
            'file' => new mfValidatorFile(['max_size' => 1000, 'required' => false]),
            'redirect_uri' => new mfValidatorUrl(['required' => true]),
        ]);
    }

    function getSettings() {
        return $this->settings = $this->settings ?: new UtilsGoogleSheetSettings();
    }
}



