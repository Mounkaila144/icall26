<?php

	
class SystemVersionsFileBase extends mfObject2 {
    
    protected static $fields=array('version','lang','module','changes','date_version','status','created_at','updated_at');
    const table="t_system_versions_file"; 
    protected static $foreignKeys=array();  
    
    function __construct($parameters=null) {
        parent::__construct();   
        $this->getDefaults(); 
        if ($parameters === null)  return $this;      
        if (is_array($parameters)||$parameters instanceof ArrayAccess)
        {
            if (isset($parameters['id']))
               return $this->loadbyId((string)$parameters['id']);     
            return $this->add($parameters); 
        }   
        else
        {
            if (is_numeric((string)$parameters)) 
               return $this->loadbyId((string)$parameters);      
        }   
    }
    
    protected function executeLoadById($db)
    {       
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."='%s';");        
        $db->makeSiteSqlQuery($this->site);       
    }
    
    protected function getDefaults()
    {
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");    
        $this->status=isset($this->status)?$this->status:'ACTIVE';          
        $this->lang=isset($this->lang)?$this->lang:'fr';  
    }
     
    protected function executeInsertQuery($db)
    {     
        $db->makeSiteSqlQuery($this->site);
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));      
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;");      
        $db->makeSiteSqlQuery($this->site);       
    }
    
    protected function executeDeleteQuery($db)
    {         
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;");
        $db->makeSiteSqlQuery($this->site);       
    }
    
    protected function executeIsExistQuery($db)    
    {
        $key_condition = ($this->getKey())?" AND ".self::getKeyName()."!={id};":"";
        $db->setParameters(array("version"=> $this->get("version")))
           ->setQuery("SELECT id FROM ".self::getTable()." WHERE version='{version}'")
           ->makeSiteSqlQuery($this->site);
        
    }
    
    function updateVersions()
    {
        //Récupirer la liste des fichiers .txt (versions)
        $versions = new mfArray();
        $files_second = new mfArray();
        foreach(glob("../../modules/system_versions/superadmin/data/versions/*/fr/*.txt") as $file_name)
        {
            $file = new FileContent($file_name,"r+");
            $versions["'".$file->getFileName()."'"] = $file->getFile();
        }
        
        //Récupirer tt les enregistrement qui existant dans la bd (par version)
        $db = mfSiteDatabase::getInstance()
           ->setQuery("SELECT DISTINCT(version) FROM ".SystemVersionsFile::getTable()." WHERE version IN(".$versions->getKeys()->implode().")")
           ->makeSiteSqlQuery($this->site);
        
        $items = new mfArray();        
        while ($row=$db->fetchArray())
        {
            unset($versions["'".$row['version']."'"]);
        }   
        
        $array_new_items = new mfArray();
        foreach($versions as $file_name)
        {
            $file = new FileContent($file_name,"+r");
            $array_new_items->merge($file->readFileAsTab());            
        }    
        
        //Insérer les nouveaux enregistrement        
        $new_items = new SystemVersionsFileCollection($array_new_items);        
        $new_items->save();
    }

    function getDetails()
    {
        return $this->details;
    }
    
    function setDetails($details)
    {
        $this->details = $details;
        return $this;
    }
    
    function addDetail($detail)
    {
        if($this->details===null)        
            $this->details = new SystemVersionsFileCollection();        
        $this->details[$detail->get("id")] = $detail;
        return $this->details;
    }
    
    function getVersions()
    {
        //Check for new updates
        $this->updateVersions();        
        $items = new mfArray();
        $db = mfSiteDatabase::getInstance();
        $db->setQuery("SELECT ".SystemVersionsFile::getFieldsAndKeyWithTable()." FROM ".SystemVersionsFile::getTable().
                      " INNER JOIN ".ModuleManager::getTable()." ON ".ModuleManager::getTableField("name")."=".SystemVersionsFileBase::getTableField("module").
                      " WHERE ".ModuleManager::getTableField("status")."='installed'".
                      " ORDER BY ".SystemVersionsFile::getTableField("id")." DESC;")
           ->makeSiteSqlQuery($this->site);
        
        if(!$db->getNumRows())
            return $items;
        
        while($item=$db->fetchObject("SystemVersionsFile"))
        {
            if(!isset($items[$item->get("version")]))
                $items[$item->get("version")] = new SystemVersionsFile(array("date_version"=>$item->get("date_version")));
            $items[$item->get("version")]->addDetail($item);
        }
        return $items;
    }
    
    function getCreatedAt()
    {
        return format_date($this->get("created_at"),"a");
    }
    
    function getDateVersion()
    {
        return format_date($this->get("date_version"),"a");
    }

    function getChanges()
    {
        return new mfString($this->get('changes'));
    }
    
    function updateVersionsDates()
    {
        //1 récupirer les versions qui n'ont pas la date !
        /*
         * SELECT DISTINCT(version) FROM `t_system_versions_file` WHERE 
         * date_version is NULL OR date_version='0000-00-00 00:00:00' 
        */
        $db = mfSiteDatabase::getInstance()
           ->setQuery("SELECT DISTINCT(version) FROM ".SystemVersionsFile::getTable()." WHERE ".SystemVersionsFile::getTableField("date_version")." IS NULL OR ".SystemVersionsFile::getTableField("date_version")."='0000-00-00 00:00:00';")
           ->makeSiteSqlQuery($this->site);
        
        if(!$db->getNumRows())
            return;
        
        $files = new mfArray();        
        while ($row=$db->fetchArray())
        {
            $files[] = "../../modules/system_versions/superadmin/data/versions/".$row['version']."/fr/".$row['version'].".txt";
        }
        
        //2 récupere la date du fichier lier a cette version !
        $versions = new mfArray();
        foreach($files as $file_path)
        {
            $file = new FileContent($file_path,"r+");
            $versions["'".$file->getFileName()."'"] = "'".$file->getDate()."'";
        }
        
        //3 update des versions dans la bd!
        /*
         * UPDATE `t_system_versions_file` SET date_version=(CASE WHEN version='{version}' THEN '{date}' 
         * WHEN version='{version}' THEN '{date}' [...] ELSE date_version  END)
        */
        
        $conditions = new mfArray();
        foreach($versions as $version=>$date)
        {
            $conditions[] = " WHEN version=".$version." THEN ".$date;
        }
        
        $db = mfSiteDatabase::getInstance()
           ->setQuery("UPDATE ".SystemVersionsFile::getTable()." SET date_version=(CASE".$conditions->implode("")." ELSE date_version END)")
           ->makeSiteSqlQuery($this->site);
        
    }
}
