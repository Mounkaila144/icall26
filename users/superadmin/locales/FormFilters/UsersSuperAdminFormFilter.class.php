<?php

class UsersSuperAdminFormFilter extends mfFormFilterBase {
 
    function configure()
    {
        $this->setClass('User');
        
        $this->setDefaults(array(
            'order'=>array(
                    "id"=>"asc",
                ),
            'search'=>array(
                    "is_active"=>"*",
                ),
            'nbitemsbypage'=>10,
        ));
        // Base Query
        $this->setQuery("SELECT {fields} FROM ".User::getTable().
                        " LEFT JOIN ".User::getOuterForJoin('unlocked_by','unlockedby').
                        " WHERE ".User::getTableField('application')."=@@APPLICATION@@".
                        ";");
        // Validators
        $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "username"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "firstname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "email"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "lastlogin"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "last_password_gen"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                        ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorInteger(array("required"=>false)),
                            "username"=>new mfValidatorString(array("required"=>false)),
                            "firstname"=>new mfValidatorString(array("required"=>false)),
                            "lastname"=>new mfValidatorString(array("required"=>false)),
                            "email"=>new mfValidatorString(array("required"=>false)),
                            "number_of_try"=>new mfValidatorString(array("required"=>false)), 
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                        ),array("required"=>false)),
            'equal' => new mfValidatorSchema(array(
                            "unlocked_by"=>new mfValidatorChoice(array("choices"=>UserUtils::getUnLockerUsers()->unshift(array(""=>"","IS_NULL"=>__("No user")))->toArray(),"key"=>true,"required"=>false)),
                            "is_locked"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                        ),array("required"=>false)),    
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
    }
  
}

