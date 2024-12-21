<?php


class UtilsHolidayCalendarSettingsForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            "holidays" => new mfValidatorTextDateI18nSchema(array("required"=>false)), //new mfValidatorSchemaForEach(new mfValidatorI18nDate(array("date_format"=>"a")),count($this->getDefault('holidays'))),
            "open_days" => new mfValidatorChoice(array("required"=>false,"multiple"=>true,"choices"=>Day::getWeekDaysName("monday",true)))
        ));
    }
    
    function getValues()
    {
        $values = parent::getValues();
        
        if(empty($values["holidays"]))
        {
            unset($values["holidays"]);
        }
        
        if(is_array($values["open_days"]))
        {
            $values["open_days"] = implode(";", $values["open_days"]);
        }
        
        return $values;
    }
}
