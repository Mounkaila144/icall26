<?php

require_once dirname(__FILE__).'/../locales/Forms/UtilsHolidayCalendarSettingsForm.class.php';

class utils_holidaysCalendarActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                   
        $this->user = $this->getUser();
        $this->settings = UtilsHolidayCalendarSettings::load();
        $this->form=new UtilsHolidayCalendarSettingsForm();
    } 
    
}
