<?php

class LanguagesFormFilter extends mfFormFilterBase {
 
    protected $query="SELECT id,code,position,is_active,application FROM t_languages WHERE application!='superadmin' ORDER BY application DESC;";
    
    function configure()
    {
       $this->setDefaults(array(
            'order'=>array(
                            "code"=>"asc",
                           //   "application"=>"desc",
            ),
            'search'=>array(
                            "is_active"=>"",
                            "application"=>"",
            ),
            'nbitemsbypage'=>"10",
       ));
       // Validators 
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "code"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "position"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "application"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "application"=>new mfValidatorChoice(array("choices"=>array(""=>"","admin"=>"admin","frontend"=>"frontend"),"required"=>false)),
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                           ),array("required"=>false)), 
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
    }
 
}

