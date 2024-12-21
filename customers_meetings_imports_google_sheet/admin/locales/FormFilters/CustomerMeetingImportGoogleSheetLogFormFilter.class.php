<?php


class CustomerMeetingImportGoogleSheetLogFormFilter extends mfFormFilterBase
{
    protected $settings = null;

    function configure()
    {
        $this->setOption('disabledCSRF',true);
        $this->setDefaults(array(
            'order' => array(
                "name" => "asc",
            ),
            'nbitemsbypage'=>50,
        ));

        $this->setQuery("SELECT {fields} FROM " . CustomerMeetingImportGoogleSheetLog::getTable() .
            " WHERE " . CustomerMeetingImportGoogleSheetLog::getTableField('format_id') . " = '{format_id}';");

        // Validators
        $this->setValidators(array(

            'order' => new mfValidatorSchema(array(
                "id" => new mfValidatorChoice(array("choices" => array("asc", "desc"), "required" => false)),
                "name" => new mfValidatorChoice(array("choices" => array("asc", "desc"), "required" => false)),
            ), array("required" => false)),
            'search' => new mfValidatorSchema(array(), array("required" => false)),
            'format_id' => new mfValidatorSchema(array(), array("required" => true)),
            'range' => new mfValidatorSchema(array(), array("required" => false)),
            'equal' => new mfValidatorSchema(array(), array("required" => false)),
            'nbitemsbypage' => new mfValidatorChoice(array("required" => false, "choices" => array("5" => "5", "10" => "10", "20" => "20", "50" => "50", "100" => "100", "*" => "*"), "key" => true)),
        ));
    }


}

