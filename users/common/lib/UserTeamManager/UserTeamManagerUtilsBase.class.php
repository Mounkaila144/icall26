<?php


class UserTeamManagerUtilsBase {
    
 /*   static function getFieldValuesForSelect($name,$site=null)
    {
        $values=array();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("name"=>$name))
                ->setQuery("SELECT DISTINCT({name}),".UserTeam::getKeyName()." FROM ".UserTeam::getTable()." ORDER BY {name} ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
            $values[$value[UserTeam::getKeyName()]]=$value[$name];
        }      
        return $values;
    }*/
    
    static function getUserByTeamManagerForSelect($manager)
    {
        $values=array();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("manager_id"=>$manager->get('id')))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".UserTeam::getTable().
                           " WHERE manager_id={manager_id}".
                           " ORDER BY lastname ASC;")               
                ->makeSiteSqlQuery($manager->getSite()); 
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
           // $values[$value[UserTeam::getKeyName()]]=$value[$name];
        }      
        return $values;
    }
    
}
