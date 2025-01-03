<?php

class CustomersFormFilter extends mfFormFilterBase {
 
   

    function configure()
    {
      $this->setDefaults(array(
            'order'=>array(
                            "id"=>"asc",
            ),
            'search'=>array(
                         //   "is_active"=>"*",
            ),
            'nbitemsbypage'=>50,
       ));
      
       $this->setQuery("SELECT * FROM ".Customer::getTable().";");
       // Validators
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "username"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "firstname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "email"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "phone"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "mobile"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "lastlogin"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "last_password_gen"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorInteger(array("required"=>false)),
                            "username"=>new mfValidatorString(array("required"=>false)),
                            "firstname"=>new mfValidatorString(array("required"=>false)),
                            "lastname"=>new mfValidatorString(array("required"=>false)),
                            "email"=>new mfValidatorString(array("required"=>false)),       
                            "mobile"=>new mfValidatorString(array("required"=>false)),       
                            "phone"=>new mfValidatorString(array("required"=>false)),       
                          //  "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                           ),array("required"=>false)),
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"25"=>25,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
    }
   
}

