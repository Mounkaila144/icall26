<?php

class SessionUtilsBase {
    
    static function getUserLastConnexion($user) {
        static $lastconnections=array();
        $user_id=$user->getId();      
        if (isset($lastconnections[$user_id]))
            return $lastconnections[$user_id];
        $db = mfSiteDatabase::getInstance()
                ->setParameters(array($user_id))
                ->setQuery("SELECT * FROM ".Session::getTable()." WHERE user_id=%d ORDER BY last_time DESC LIMIT 1,1;")
                ->makeSiteSqlQuery();
        if ($db->getNumRows())
        {        
           $lastconnections[$user_id]=$db->fetchObject('session');
           $lastconnections[$user_id]->loaded();
        }   
        else
          $lastconnections[$user_id]=new Session();        
        return $lastconnections[$user_id];
    }
    
    
   /* static function getSessionsFromPager($pager)
    {
         if (!$pager->hasItems())
             return ;
         $db = mfSiteDatabase::getInstance()
                ->setParameters(array('time'=>date("Y-m-d H:i:s",time() - 3600 * 5)))
                ->setQuery("SELECT * FROM ".Session::getTable().
                           " WHERE start_time IN (".
                                " SELECT MAX(start_time) FROM ".Session::getTable().
                                " WHERE user_id IN('".implode("','",array_keys($pager->getItems()))."')".
                                ") AND last_time > '{time}';")
                ->makeSiteSqlQuery($pager->getSite());
       //  echo $db->getQuery();
        if ($db->getNumRows())
        {    
            while ($item=$db->fetchObject('Session'))
            { 
                $pager->items[$item->get('user_id')]->session=$item->loaded();
            }                        
        }   
    }*/
   
    static function clean($site=null)
    {       
        $settings=new UserGuardSettings(null,$site);
         $db = mfSiteDatabase::getInstance()
                ->setParameters(array('time'=>date("Y-m-d H:i:s",time() - ($settings->get('cleanup_session_period',10) * 3600 * 24 ))))  // 5 last days
                ->setQuery("DELETE FROM ".Session::getTable().
                           " WHERE start_time <= '{time}';")
                ->makeSiteSqlQuery($site);       
    }   
    
    
     static function getIpsForSelect($site=null)
    {
         $list =new mfArray();
         $db = mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ip FROM ".Session::getTable().
                           " GROUP BY ip".
                           ";")
                ->makeSiteSqlQuery($site);
       //  echo $db->getQuery();
        if (!$db->getNumRows())
           return $list;  
        while ($row=$db->fetchArray())
           $list[$row['ip']]=$row['ip'];                
        return $list;             
    }
}

