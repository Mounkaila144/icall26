<?php

class LanguagesFrontendFormFilter extends mfFormFilterBase {
 
    
    function configure()
    {
       $this->setDefaults(array(
            'order'=>array(
                            "position"=>"asc",
            ),
            'search'=>array(
                            "is_active"=>"",
            ),
            'nbitemsbypage'=>"10",
       ));
       // Query
       $this->setQuery("SELECT * FROM t_languages WHERE application='frontend';");
       // Validators 
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "code"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "position"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                           ),array("required"=>false)), 
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"*"=>"*"))),         
        ));
    }
 
}

