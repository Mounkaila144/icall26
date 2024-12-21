<?php

class cronFormFilter extends mfFormFilterBase {
 
    function configure()
    {
      $this->setDefaults(array(
            'order'=>array(
                            "name"=>"asc",
            ),
            'search'=>array(
                            "is_active"=>"*",
            ),
            'nbitemsbypage'=>100,
       ));
       
      $this->setQuery("SELECT * FROM ".cron::getTable().";");
       // Validators
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "title"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "email"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "lastlogin"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "last_password_gen"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorInteger(array("required"=>false)),
                            "name"=>new mfValidatorString(array("required"=>false)),
                            "title"=>new mfValidatorString(array("required"=>false)),
                          //  "lastname"=>new mfValidatorString(array("required"=>false)),
                          //  "email"=>new mfValidatorString(array("required"=>false)),
                        //    "application"=>new mfValidatorChoice(array("choices"=>array(""=>"","admin"=>"admin","frontend"=>"frontend"),"required"=>false)),
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                           ),array("required"=>false)),
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
    }
   
}

