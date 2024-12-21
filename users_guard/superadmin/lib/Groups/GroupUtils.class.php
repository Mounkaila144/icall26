<?php


class GroupUtils extends GroupUtilsBase {
    
        static  function getGroups($application,$site=null)
    {
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT * FROM ".Group::getTable(). 
                       " WHERE application='".$application."'".                    
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        $groups=array();
        while ($item=$db->fetchObject('Group'))
        {          
             $item->site=$site;
             $groups[$item->get('id')]=$item->loaded();                 
        }  
        return $groups;   
    }
    
    static function getAdminGroupsForSelect($site=null)
    {
       static $groups;
       
       $groups=new mfArray();
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT name,id FROM ".Group::getTable(). 
                       " WHERE application='admin' ".                      
                       " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $groups;       
        while ($row=$db->fetchArray())
        {                       
             $groups[$row['id']]=$row['name'];                 
        }  
        return $groups;   
    }
    
   
}
