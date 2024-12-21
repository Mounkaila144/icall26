<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cronUtils
 *
 * @author fred
 */
class CronUtils {
    
    static function clearDatabase()
    {
        $db=mfSiteDatabase::getInstance();
        $db->setQuery("DELETE FROM ".Cron::getTable().";")
            ->makeSqlQuerySuperAdmin();  
    }
}

