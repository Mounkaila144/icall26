<?php
 
class AllPermissionsSuperAdminFormFilter extends mfFormFilterBase {
 
    function configure()
    {
      $this->setClass('Permission');
      $this->setDefaults(array(
            'order'=>array(
                            "id"=>"asc",
            ),
            'search'=>array(
                        
            ),
            'nbitemsbypage'=>10,
       ));
       // Base Query
       $this->setQuery("SELECT t_permissions.id ,t_permissions.name AS name,t_user_group.is_active,t_user_group.group_id as group_id,
                               t_user_permission.id as user_permission_id,t_group_permission.id as group_permission_id,
                               t_user_group.id as user_group_id,t_groups.name as group_name
                        FROM t_permissions
                        LEFT JOIN t_user_permission ON t_user_permission.permission_id=t_permissions.id AND t_user_permission.user_id={user_id}
                        LEFT JOIN t_group_permission ON t_permissions.id=t_group_permission.permission_id  
                        LEFT JOIN t_user_group ON t_user_group.group_id=t_group_permission.group_id  AND t_user_group.user_id={user_id}           
                        LEFT JOIN t_groups ON t_groups.id=t_group_permission.group_id 
                        WHERE t_permissions.application='superadmin'  AND (t_user_group.user_id={user_id} OR t_user_permission.user_id={user_id});
                       ");
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
                           // "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                           ),array("required"=>false)),
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"),"required"=>false)),         
              
        ));
    }
  
}

