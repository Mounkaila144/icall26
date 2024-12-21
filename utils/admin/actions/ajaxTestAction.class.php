<?php

require_once dirname(__FILE__).'/../locales/Forms/UtilsHolidayCalendarSettingsForm.class.php';

class utils_ajaxTestAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {         
            $this->user = $this->getUser();
            $this->settings = UtilsHolidayCalendarSettings::load();
            $this->form = new UtilsHolidayCalendarSettingsForm();  
//            echo "<pre>"; var_dump($this->settings->getHolidays()); echo "</pre>";
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
//        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;      
    }

}

