<?php

class GroupPermissionsFormFilter extends mfFormFilterBase {
 
    function configure()
    {
      $this->setClass('GroupPermission');
      $this->setFields(array(
          'application'=>'Permission',
          'name'=>'Permission'
      ));
      $this->setDefaults(array(
            'order'=>array(
                            "id"=>"asc",
            ),
            'search'=>array(
                        
            ),
            'nbitemsbypage'=>10,
       ));
       // Base Query
       $this->setQuery("SELECT t_group_permission.id,t_permissions.name,t_permissions.updated_at,t_permissions.created_at 
                        FROM t_group_permission 
                        LEFT JOIN t_permissions ON t_permissions.id=t_group_permission.permission_id                      
                        WHERE t_permissions.application=@@APPLICATION@@ AND t_group_permission.group_id=%d;");
       // Validators
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "application"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "updated_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         //   "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorInteger(array("required"=>false)),
                            "name"=>new mfValidatorString(array("required"=>false)),                           
                          //  "application"=>new mfValidatorChoice(array("choices"=>array(""=>"","admin"=>"admin","frontend"=>"frontend"),"required"=>false)),
                           // "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                           ),array("required"=>false)),
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"),"required"=>false)),         
              
        ));
    }
  
}

