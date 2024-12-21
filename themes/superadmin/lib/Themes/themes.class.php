<?php

class Themes extends Theme {

    const table="t_themes";
            
    function __construct($parameters=null,$application=null) 
    {
      $this->setApplicationAndSite($application); 
      if ($parameters===null) return $this;       
      if (is_array($parameters)||$parameters instanceof ArrayAccess) {
            if (isset($parameters['id']))
                return $this->loadById((string)$parameters['id']);
            return $this->add($parameters); 
       }  
       else {           
           if (is_numeric((string)$parameters))
                $this->loadById((string)$parameters); 
           else
             $this->loadByName((string)$parameters);   
       } 
    }
      
    protected function loadByName($name)
     {
        $db=mfSiteDatabase::getInstance()
           ->setParameters($name)
           ->setQuery("SELECT * FROM ".self::getTable()." WHERE name='%s' AND application='{application}';")
           ->makeSqlQuerySuperAdmin($this->application);  
        return $this->rowtoObject($db);
     }
     
     protected function executeLoadById($db)
     {
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSqlQuerySuperAdmin($this->application);  
     }
    
    protected function executeInsertQuery($db)
    {
       $db->makeSqlQuerySuperAdmin($this->application);  
    }
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSqlQuerySuperAdmin($this->application);  
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSqlQuerySuperAdmin($this->application);  
    }
      

  /*  protected function getPreviewFile()
    {
       foreach (glob($this->getDirectory()."/config/preview.*") as $file)
       {    
           if (is_readable($file))
           {    
             return $this->set('preview',basename($file));
           }
       }    
    }*/
    
 /*   protected function insert()
    {
        $this->getPreviewFile();
        parent::insert();
    }*/
    
    public function delete()
    {
        parent::delete();
        mfFileSystem::net_rmdir($this->getDirectory());
    }
    
    
    public function getZipName()
    {
        return $this->get('name').".zip";
    }
    
    public function outputZip()
    {
       $zip=new ZipExtended(mfConfig::get('mf_site_app_cache_dir')."/data/themes/".$this->getZipName(),  ZipArchive::CREATE); 
       if (!$zip->open())
          throw new mfException("ZIP error");
       $zip->addDirectory($this->getDirectory(),$this->getDirectory());    
       $zip->close();
       $zip->output();
    }
    
    
}

