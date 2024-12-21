<?php

class UserGroupMultipleProcess {
   
    protected $site=null,$selection=null,$parameters=null,$messages=array(),$actions=null;
    
    function __construct(mfArray $selection,$actions,$parameters=array(),$site=null) {
        $this->site=$site;
        $this->selection=$selection;    
        $this->actions=$actions;
        $this->parameters=$parameters;
        $this->messages=new mfArray();
    }
    
    function getActions()
    {
        return $this->actions;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getSelection()
    {
        return $this->selection;
    }
    
    function getParameters()
    {
        return $this->parameters;
    }
    
    function getParameter($name,$defaults=null)
    {
        return isset($this->parameters[$name])?$this->parameters[$name]:$defaults;
    }        
    
    function process()
    {              
        
      //  echo "<pre>"; var_dump($this->parameters);
        if ($this->getActions()->in('delete_permissions'))
        {
            if ($this->getParameter('delete_permissions')->isEmpty())
                return $this;                                 
            $db=mfSiteDatabase::getInstance()
                   ->setParameters(array())
                   ->setQuery("DELETE ".GroupPermission::getTable()." FROM ".GroupPermission::getTable().
                              " INNER JOIN ".GroupPermission::getOuterForJoin('permission_id').
                              " WHERE ".GroupPermission::getTableField('group_id')." IN('".$this->getSelection()->getKeys()->implode("','")."')".
                                    " AND ".Permission::getTableField('name')." IN('".$this->getParameter('delete_permissions')->implode("','")."')".
                                    " AND ".Permission::getTableField('name')." NOT LIKE '%%superadmin%%'".
                              ";")              
                   ->makeSiteSqlQuery($this->getSite());     
         //   echo $db->getQuery();
            
        }
        if ($this->getActions()->in('add_permissions'))
        {
            if ($this->getParameter('add_permissions')->isEmpty())
                return $this;                                             
            $permissions= PermissionUtils::getPermissionsExceptSuperAdminFromSelection( $this->getParameter('add_permissions'),$this->getSite());
            if ($permissions->isEmpty())
                return $this;                          
            foreach ($this->getSelection() as $group)
            {               
                foreach ($permissions as $permission)
                {
                    $group_permission=new GroupPermission(array('permission_id'=>$permission->get('id'),'group_id'=>$group->get('id')),$this->getSIte());
                    $group_permission->save();
                }   
            }      
        }
       
        return $this;
    }
    
    function getMessages()
    {
        return $this->messages;
    }
    
}

