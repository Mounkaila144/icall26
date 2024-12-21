
<?php

class MarketingLeadsWpFormsLeadsImportLogFileFormFilter extends mfFilesFormFilter {
 
    function configure()
    {
        $this->setDefaults(array(
            'order'=>array(
                
            ),
            'search'=>array(
                
            ),
            'range'=>array(
                
            ),
            'nbitemsbypage'=>"50",
       ));
       // Base Query
       $this->setQuery("*system_error*.log"); 
       // Validators 
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "time"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "size"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "extension"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                        ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "name"=>new mfValidatorString(array("required"=>false)),
                        ),array("required"=>false)),
            'range'=>new mfValidatorSchema(array(
                            "time"  =>new mfValidatorI18nDateRangeCompare(array('required'=>false))
                        ),array("required"=>false)),
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
    }
}

