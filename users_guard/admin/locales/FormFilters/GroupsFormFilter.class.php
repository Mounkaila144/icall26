<?php

class GroupsFormFilter extends mfFormFilterBase {
 
    function configure()
    {
    /*  $this->addDefaults(array(
            'order'=>array(
                         //   "application"=>"asc",
            ),
            'search'=>array(
                         // "is_active"=>"",
            ),
         //   'nbitemsbypage'=>10,
       ));*/
      $this->setFields(array(
                'permission'=>null,
                'permission_id'=>array('class'=>'Permission','name'=>'id'),
                'permission_name'=>array('class'=>'Permission','name'=>'name'),
                'number_of_users'=>"",
                'is_active'=>array('class'=>'Group'),
       ));
       // Base Query
        $query="";
        $groupby="";        
         if ($this->defaults['search']['permission'])
         {               
            $query=" INNER JOIN ". GroupPermission::getInnerForJoin ('group_id');   
            $query.=" INNER JOIN ". GroupPermission::getOuterForJoin ('permission_id');   
           // $groupby=" GROUP BY ".Group::getTableField('id');
         }           
       $this->setQuery("SELECT ".Group::getFieldsAndKeyWithTable().
                       ",count(".UserGroup::getTableField('id').") as number_of_users".                            
                       " FROM ".Group::getTable().
                        $query.
                        " LEFT JOIN ".UserGroup::getInnerForJoin('group_id').
                       " WHERE ".Group::getTablefield('application')." ='admin' AND ".Group::getTablefield('name')." !='superadmin'".
                       " GROUP BY ".Group::getTableField('id').
                       ";");
       // Validators
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "updated_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "number_of_users"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorInteger(array("required"=>false)),
                            "name"=>new mfValidatorString(array("required"=>false)),
                            "permission"=>new mfValidatorString(array("required"=>false)),  
                            "number_of_users"=>new mfValidatorString(array("required"=>false)),  
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                         //   "application"=>new mfValidatorChoice(array("choices"=>array(""=>"","admin"=>"admin","frontend"=>"frontend"),"required"=>false)),
                           ),array("required"=>false)),
             'equal' => new mfValidatorSchema(array(                           
                             "permission_id"=>new mfValidatorChoice(array("required"=>false,'key'=>true,'choices'=> PermissionUtils::getNotSuperadminPermissionsForSelect())),                                                        
                             "permission_name"=>new mfValidatorChoice(array("required"=>false,'key'=>true,'choices'=> PermissionUtils::getNotSuperadminPermissionsByNameForSelect())),                                                        
                           ),array("required"=>false)),
         //  'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
    }
  
    
    function getQuery()
    {
         if ($this->query_valid)
             return $this->query; 
         if ($this->values['search']['permission']) 
         {
              $permission=new Permission($this->values['search']['permission'],'admin');
              if ($permission->isLoaded() && !$permission->isSuperAdmin())
                 $this->values['equal']['permission_id']=$permission->get('id');
              else            
                 $this->values['equal']['permission_name']=str_replace(array("superadmin"),"not_authorized",$this->values['search']['permission']);             
         }     
        return parent::getQuery();
    }
}

