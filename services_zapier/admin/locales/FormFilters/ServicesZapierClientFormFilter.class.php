<?php


class ServicesZapierClientFormFilter extends mfFormFilterBase
{

    function configure()
    {

        $this->setDefaults(array(
            'order' => array(
                "name" => "asc",
            ),
            'nbitemsbypage'=>10,
        ));
        $this->setQuery("SELECT {fields} FROM " . ServicesZapierClient::getTable() .
            ";");
        // Validators
        $this->setValidators(array(

            'order' => new mfValidatorSchema(array(
                "id" => new mfValidatorChoice(array("choices" => array("asc", "desc"), "required" => false)),
            ), array("required" => false)),
            'search' => new mfValidatorSchema(array(), array("required" => false)),
            'range' => new mfValidatorSchema(array(), array("required" => false)),
            'nbitemsbypage' => new mfValidatorChoice(array("required" => false, "choices" => array("5" => "5", "10" => "10", "20" => "20", "50" => "50", "100" => "100", "*" => "*"), "key" => true)),
        ));

    }

}

