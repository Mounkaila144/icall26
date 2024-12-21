<?php


class CustomerMeetingImportGoogleSheetFormatFormFilter extends mfFormFilterBase
{
    protected $settings = null;

    function configure()
    {
        $this->settings = UtilsGoogleSheetSettings::load();

        $this->setDefaults(array(
            'order' => array(
                "name" => "asc",
            ),
            'nbitemsbypage'=>10,
        ));
        $this->setQuery("SELECT {fields} FROM " . CustomerMeetingImportGoogleSheetFormat::getTable() .
            ";");
        // Validators
        $this->setValidators(array(

            'order' => new mfValidatorSchema(array(
                "id" => new mfValidatorChoice(array("choices" => array("asc", "desc"), "required" => false)),
                "name" => new mfValidatorChoice(array("choices" => array("asc", "desc"), "required" => false)),
            ), array("required" => false)),
            'search' => new mfValidatorSchema(array(), array("required" => false)),
            'range' => new mfValidatorSchema(array(), array("required" => false)),
            'equal' => new mfValidatorSchema(array(
                "status"=>new mfValidatorChoice(array("choices"=>array(""=>"", 0=> __("not started"), 1=> __("interrupted"), 2=> __("finished")),"key"=>true,"required"=>false)),
                ), array("required" => false)),
            'nbitemsbypage' => new mfValidatorChoice(array("required" => false, "choices" => array("5" => "5", "10" => "10", "20" => "20", "50" => "50", "100" => "100", "*" => "*"), "key" => true)),
        ));

    }

    function getSettings()
    {
        return $this->settings;
    }


}

