<?php

class LogsUtils {
    
    static function getLogDirectory()
    {
        return mfConfig::get('mf_log_dir');
    }
    
    static function getLogs()
    {
        $files=array();
        foreach (glob(self::getLogDirectory()."/*system_error*.log") as $file)
        {
           $files[]=basename($file);
        }
        return $files;
    }
    
     static function removeAll()
    {
        //mfFileSystem::net_rmdir(mfConfig::get('mf_log_dir'));        
         foreach (self::getLogs() as $file)
         {
             $log=new LogFile($file);
             $log->delete();
         }    
    }
    
    static function deleteLogsForCron()
    {
        foreach(self::getLogs() as $log_file)
        {
            $log = new LogFile($log_file);
            $date_log=$log->getDate();            
            $today = new Day();            
            if($date_log < $today->getDaySub(LogsSettings::load()->get('nb_days',10)))
            {                
               $log->delete();  
            }               
        }
    }
    
    static function getCronLogs()
    {
        $files=array();
        foreach (glob(self::getLogDirectory()."/*cron*.log") as $file)
        {
           $files[]=basename($file);
        }
        return $files;
    }
    
    static function deleteCronLogsForCron()
    {
        foreach(self::getCronLogs() as $log_file)
        {
            $log = new LogFile($log_file);
            $date_log=$log->getDate();            
            $today = new Day();            
            if($date_log < $today->getDaySub(LogsSettings::load()->get('nb_days',10)))
            {                
               $log->delete();  
            }               
        }
    }
    
    static function deleteCronLogs()
    {       
        foreach (glob(self::getLogDirectory()."/*cron*.log") as $file)        
           @unlink($file);             
    }
}

