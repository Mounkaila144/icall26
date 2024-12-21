<?php


class SessionUtils extends SessionUtilsBase {
    
   /* static function getUserLastConnexion($user) {
        static $lastconnections=array();
        $user_id=$user->getId();      
        if (isset($lastconnections[$user_id]))
            return $lastconnections[$user_id];
        $db = mfSiteDatabase::getInstance()
                ->setParameters(array($user_id))
                ->setQuery("SELECT * FROM t_sessions WHERE user_id=%d ORDER BY last_time DESC LIMIT 1,1;")
                ->makeSiteSqlQuery();
        if ($db->getNumRows())
        {        
           $lastconnections[$user_id]=$db->fetchObject('session');
           $lastconnections[$user_id]->loaded();
        }   
        else
          $lastconnections[$user_id]=new Session();        
        return $lastconnections[$user_id];
    }*/
    
    static function getLastTimeMin()
    {
        $db = mfSiteDatabase::getInstance()
                ->setQuery("SELECT MIN(last_time) FROM t_sessions LEFT JOIN t_users ON t_users.id=t_sessions.user_id;")
                ->makeSiteSqlQuery();
        if ($db->getNumRows())
        {
          $row=$db->fetchRow();
          return $row[0];
        }
        else
        {
            return date("Y-m-d");
        }    
    }
    
    static function getLastTimeMinFrontendAndAdmin($site="")
    {
        $db = mfSiteDatabase::getInstance()
                ->setQuery("SELECT MIN(last_time) FROM t_sessions LEFT JOIN t_users ON t_users.id=t_sessions.user_id WHERE application!='superadmin';")
                ->makeSiteSqlQuery($site);
        if ($db->getNumRows())
        {
          $row=$db->fetchRow();
          return $row[0];
        }
        else
        {
            return date("Y-m-d");
        }    
    }
    
    static function cleanUpAllSites()
    {
        foreach (SitesAdmin::getlistSitesByName() as $site)     
        {
            self::clean($site);
        }    
    }
}

