<?php

class UserGroupsFormFilter extends mfFormFilterBase {
 
    function configure()
    {
      $this->setFields(array("name"=>"Group"));
      $this->setClass('UserGroup');
      $this->setDefaults(array(
            'order'=>array(
                           "id"=>"asc",
            ),
            'search'=>array(
                           "is_active"=>"",
            ),
            'nbitemsbypage'=>10,
       ));
       // Base Query
       $this->setQuery("SELECT t_user_group.id,t_groups.name,t_user_group.is_active
                        FROM t_user_group 
                        LEFT JOIN t_groups ON t_groups.id=t_user_group.group_id                      
                        WHERE t_groups.application=@@APPLICATION@@ AND t_user_group.user_id=%d;");
       // Validators
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "updated_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorInteger(array("required"=>false)),
                            "name"=>new mfValidatorString(array("required"=>false)),                           
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                           ),array("required"=>false)),
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"),"required"=>false)),         
              
        ));
    }
  
}

