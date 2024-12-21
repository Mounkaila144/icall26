<?php

class groupPermissionCollection extends mfObjectCollection2 {
     
    function __construct($data=null,$site=null) {
       parent::__construct($data, null, $site);
    }
    
    protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT ".$this->getTableKey().",".GroupPermission::getTableField('group_id')." FROM ".$this->getTable().
                      " LEFT JOIN ".Permission::getTable()." ON ".Permission::getTableKey()."=permission_id".
                      " WHERE ".$this->getWhereConditions()." AND application@@IN_APPLICATION@@;")
           ->makeSqlQuery($this->application,$this->site);     
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSiteSqlQuery($this->site);   
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
            ->makeSiteSqlQuery($this->site); 
    }
    
    function getPermissions()
    {
        if ($this->permissions===null)
        {    
            $selection = new mfArray();
            foreach ($this as $item)        
                $selection->push($item->get('permission_id'));        
             $this->permissions= PermissionUtils::getPermissionsFromSelection($selection,$this->getSite());
        }
        return $this->permissions;
    }
}

