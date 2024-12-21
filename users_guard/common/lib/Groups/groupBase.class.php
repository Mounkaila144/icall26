<?php

class GroupBase extends mfObject2 {
     
    protected static $fields=array('name','is_active','application','updated_at');   
    const table="t_groups";
    
    function __construct($parameters=null,$application=null,$site=null) {
      parent::__construct($application,$site);
      $this->getDefaults();
      if ($parameters===null) return $this; 
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
           if (isset($parameters['name']))
             return $this->loadbyName((string)$parameters['name']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            $this->loadbyId((string)$parameters);
        else 
           $this->loadbyUpperOrLowerName((string)$parameters);         
      }   
    }
    
    protected function loadByUpperOrLowerName($name)
    {
        $this->set('name',$name);
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lower_name'=>strtolower($name),'upper_name'=>strtoupper($name)))
                ->setQuery("SELECT * FROM ".self::getTable()."
                        WHERE (name='{lower_name}' OR  name='{upper_name}') AND application@@IN_APPLICATION@@;")
                 ->makeSqlQuery($this->application,$this->site); 
        $this->rowtoObject($db);
    }
    
    protected function loadByName($name)
    {
        $this->set('name',$name);
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('name'=>$name))
                ->setQuery("SELECT * FROM ".self::getTable()." WHERE name='{name}' AND application@@IN_APPLICATION@@;")
                 ->makeSqlQuery($this->application,$this->site); 
        $this->rowtoObject($db);
    }
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()."
                        WHERE id=%d AND application@@IN_APPLICATION@@;")
                  ->makeSqlQuery($this->application,$this->site);  
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d AND application@@IN_APPLICATION@@;")
          ->makeSqlQuery($this->application,$this->site);
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
       $this->is_active=isset($this->is_active)?$this->is_active:"NO";
    }   
    
    protected function executeInsertQuery($db)
    {
       $db->makeSqlQuery($this->application,$this->site);
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE id=%d AND application@@IN_APPLICATION@@;")
            ->makeSqlQuery($this->application,$this->site);    
    }
    
    protected function executeIsExistQuery($db)    
    {
      $parameters=array($this->name);  
      if ($this->id)
      {
          $parameters[]=$this->id;
          $query="SELECT id FROM ".self::getTable()." WHERE name='%s' AND id!=%d AND application@@IN_APPLICATION@@;";    
      }         
      else
      {    
         $query="SELECT id FROM ".self::getTable()." WHERE name='%s' AND application@@IN_APPLICATION@@;";               
      }
      $db->setParameters($parameters)
            ->setQuery($query)
            ->makeSqlQuery($this->application,$this->site);      
    }
    
    
    
    // GETTERS    
    function getId()
    {
        return $this->id;        
    }
    
    function getName()
    {
        return $this->name;
    }
    
    function __toString() {
        return $this->name;
    }
    
    function getI18n()
    {
        if (!$this->i18n)
        {
            $this->i18n=__($this->get('name'),'','groups','users_guard');
        }   
        return $this->i18n;
    }
    
    function getPlurialI18n()
    {
        if (!$this->plurial_i18n)
        {
            $this->plurial_i18n=__($this->get('name')."s",'','groups','users_guard');
        }   
        return $this->plurial_i18n;
    }
    
    function getPermissions()
    {
        if ($this->permissions)
            return $this->permissions;
        $this->permissions=new mfArray();
        if (!$this->isLoaded())
           return $this->permissions;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('group_id'=>$this->get('id'),'application'=>$this->get('application')))
                 ->setQuery("SELECT ".Permission::getFieldsAndKeyWithTable()." FROM ".Permission::geTable().
                            " LEFT JOIN ".GroupPermission::getInnerForJoin('permission_id').
                            " WHERE ".Permission::getTableField('application')."='{application}' AND ".
                                GroupPermission::getTableField('group_id')."='{group_id}'".
                            " ORDER BY ".Permission::getTableField('name')." ASC".
                            ";")            
                ->makeSiteSqlQuery($this->getSite()); 
        if (!$db->getNumRows())
            return $this->permissions;        
        while ($item=$db->fetchObject('Permission'))
        {
           $item->setSite($this->getSite());
           $this->permissions[$item->get('id')]=$item->loaded();
        }
        return $this->permissions;
    }
    
    function getPermissionsId()
    {
        if ($this->permissions)
            return $this->permissions;
        $this->permissions=array();
        if (!$this->isLoaded())
           return $this->permissions;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('group_id'=>$this->get('id'),'application'=>$this->get('application')))
                 ->setQuery("SELECT ".Permission::getTableField('id')." FROM ".Permission::getTable().
                            " LEFT JOIN ".GroupPermission::getInnerForJoin('permission_id').
                            " WHERE ".Permission::getTableField('application')."='{application}' AND ".
                                GroupPermission::getTableField('group_id')."='{group_id}'".
                            " ORDER BY ".Permission::getTableField('name')." ASC".
                            ";")            
                ->makeSiteSqlQuery($this->getSite()); 
        if (!$db->getNumRows())
            return $this->permissions;        
        while ($row=$db->fetchArray())
        {           
           $this->permissions[$row['id']]=$row['id'];
        }
        return $this->permissions;
    }
    
    function updatePermissions($permissions)
    {
        $db=mfSiteDatabase::getInstance();
        if (empty($permissions))
        {
            $db->setParameters(array('group_id'=>$this->get('id')))
                 ->setQuery("DELETE FROM ".GroupPermission::getTable()." WHERE group_id={group_id};")
                 ->makeSiteSqlQuery($this->getSite());
            return ;
        }         
        if ($permissions)
        {    
            // Remove not used permissions
            $db->setParameters(array('group_id'=>$this->get('id')))
                     ->setQuery("DELETE FROM ".GroupPermission::getTable()." WHERE group_id={group_id} AND permission_id NOT IN(".implode(",",$permissions).");")
                     ->makeSiteSqlQuery($this->getSite());
        }         
                        
        // get existing 
        $db->setParameters(array('group_id'=>$this->get('id')))
                 ->setQuery("SELECT * FROM ".GroupPermission::getTable()." WHERE group_id={group_id};")
                 ->makeSiteSqlQuery($this->getSite());
        $collection=new GroupPermissionCollection(null,$this->getSite());        
        if ($db->getNumRows())
        {      
            while ($item=$db->fetchObject('GroupPermission'))
            {                      
               $item->setSite($this->getSite());
               $collection[]=$item->loaded();            
               if (($key=array_search($item->get('permission_id'),$permissions))!==false)
               {                 
                  unset($permissions[$key]);               
               }   
            }     
        }       
                 
        // Add new user permissions        
        foreach ($permissions as $permission_id)
        {
            $item= new GroupPermission(null,$this->getSite());
            $item->add(array('group_id'=>$this->get('id'),'permission_id'=>$permission_id));
            $collection[]=$item;
        }    
        $collection->save();
        return $this;
    }
    
    function copy()
    {
        $group=new Group(null,'admin',$this->getSite());
        $group->add(array('name'=>$this->get('name')."-1","is_active"=>"YES"));
        $group->save();
        $permissions=$this->getPermissionsId();  
        if ($permissions)
        {
            $collection=new GroupPermissionCollection(null,$this->getSite());
            foreach ($permissions as $id)
            {
                $item=new GroupPermission(null,$this->getSite());
                $item->add(array('group_id'=>$group->get('id'),'permission_id'=>$id));
                $collection[]=$item;        
            }    
            $collection->save();
        }    
        return $group;
    }
    
    function getNumberOfUsersAffected()
    {
        return $this->number_of_users_affected;
    }
    
    function affectTo(Group $group)
    {
        if (!$group || $group->isNotLoaded())
            return $this;    
        $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('group_id'=>$this->get('id'),'new_group_id'=>$group->get('id')))
                 ->setQuery("UPDATE ".UserGroup::getTable().
                            " SET group_id='{new_group_id}'".
                            " WHERE group_id={group_id};")
                 ->makeSiteSqlQuery($this->getSite());
        
        $this->number_of_users_affected=$db->getAffectedRows();
        
        return $this;
    }
    
    function addPermissions(mfArray $permissions_to_create)
    {
        if ($this->isNotLoaded())
            return $this;      
        // si existe supprimer de la liste a créer
        $permissions=new mfArray();
        foreach ($permissions_to_create as $name)
        {
            $permission= new Permission($name,'admin',$this->getSite());
            $permission->save();      
            $permissions[$permission->get('id')]=$permission;
        }  
        foreach ($permissions as $permission)
        {
            $group_permission=new GroupPermission(array('permission_id'=>$permission->get('id'),'group_id'=>$this->get('id')),$this->getSite());
            $group_permission->save();
        } 
        return $this;
    }
    
   /* function addPermission(Permission $permission){
        if(isset($this->_permissions[$permission->get('id')]))
            return $this;
        $this->_permissions[$permission->get('id')]=$permission->loaded();
        return $this;
    }
    
    function addFunction(UserFunction $function){
        if(isset($this->functions[$function->get('id')]))
            return $this;
        $this->functions[$function->get('id')]=$function->loaded();
        return $this;
    }*/
    
    
    function getPermissionsList(){
        
        if ($this->_permissions===null)
        {
           $this->_permissions=new PermissionCollection(null,$this->getSite());
        }
        return $this->_permissions;
        
    }
    
}
