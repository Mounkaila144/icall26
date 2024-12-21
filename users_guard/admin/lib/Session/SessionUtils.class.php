<?php


class SessionUtils extends SessionUtilsBase {
    
  /*
    
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
    }*/
    
    static function getLastTimeMinFrontend()
    {
        $db = mfSiteDatabase::getInstance()
                ->setQuery("SELECT MIN(last_time) FROM ".Session::getTable().                         
                           " LEFT JOIN ".Session::getOuterForJoin('user_id').
                           " WHERE application='frontend';")
                ->makeSqlQuery();        
        if (!$db->getNumRows())
            return date("Y-m-d");       
        $row=$db->fetchRow();
        return $row[0];       
    }
}

