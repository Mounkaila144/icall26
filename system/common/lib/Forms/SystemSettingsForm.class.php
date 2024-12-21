<?php



 class SystemSettingsForm extends mfForm {
 
   
    function configure()
    {        
        $this->setValidators(array(            
           'holidays' => new mfValidatorTextDateI18nSchema(array("required"=>false)),
           'time_shift'=>new mfValidatorChoice(array('choices'=>SystemSettings::getGmtRange()->toArray(),'key'=>true)),
           'open_days' => new mfValidatorChoice(array("required"=>false,"key"=>true,"multiple"=>true,"choices"=>Day::getWeekDaysNameI18n("monday")))
            ) 
        );                      
    }
   
}


