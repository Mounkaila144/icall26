<?php
	
class MarketingLeadsWpFormsLeadsImportFileBase extends mfObject2 {
    
    protected static $fields=array('name','file','number_of_leads','number_of_lines','lines_processed','application','user_id',
                                    'format_id','has_header','columns','file_log','site_id',
                                    'filesize','status','created_at','updated_at');
    const table="t_marketing_leads_file_import"; 
    protected static $foreignKeys=array('user_id'=>'User',
                                        'site_id'=>'MarketingLeadsWpLandingPageSite'
                                        );  
    
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
        $db->makeSqlQuery();         
    }
    
    protected function getDefaults()
    {
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");    
        $this->status=isset($this->status)?$this->status:'ACTIVE';  
        $this->has_header=isset($this->has_header)?$this->has_header:'YES';         
//        $this->number_of_leads=isset($this->number_of_leads)?$this->number_of_leads:0;         
//        $this->lines_processed=isset($this->lines_processed)?$this->lines_processed:0;         
    }
     
    protected function executeInsertQuery($db)
    {     
        $db->makeSqlQuery(); 
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));      
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;");      
        $db->makeSqlQuery();        
    }
    
    protected function executeDeleteQuery($db)
    {         
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;");
        $db->makeSqlQuery();        
    }
    
    protected function executeIsExistQuery($db)    
    {
        
    }
        
    public function getFileDirectory()
    {
        return mfConfig::get('mf_site_admin_dir')."/data/marketing/imports/".$this->get('id');
    }
    
    public function getFile()
    {
        if (!$this->_file)  
        {    
            $this->_file=new CsvFileObject(array(
                "path"=>$this->getFileDirectory(),
                "file"=>$this->get('file'),
                //"urlAdmin"=>url_to('campaigns_import_file',array('id'=>$this->get('id'))), //"/products/download/".$this->getSite()->get('site_host')."/",
                "url"=>url_to('marketing_leads_import_file',array('id'=>$this->get('id'),'file'=>$this->get('file'))),              
            ));
        }     
        return $this->_file; 
    } 
      
    static function getName($name)
    {      
        return preg_replace('/[^abcdefghijklmnopqrstuvwxyz0123456789\.\-]/i', '-', str_replace(" ","-",mfTools::I18N_noaccent($name)));
    } 
    
    function setFilename($filename)
    {
        $this->set('file',self::getName($filename));
        return $this->get('file');
    } 
    
    function setFile($file)
    {
        $this->set('name',$file->getOriginalFilename());                    
        $csv_file=new CsvFile($file->getTempName());
        $this->set('number_of_lines',$csv_file->getNumberOfLines());
        $this->set('filesize',$csv_file->getSize());                         
        $this->setFilename($this->get('name').".csv");   
        return $this;
    }
    
    function addLine($num)
    {
        $lines=$this->get('lines_processed')+$num;
        if ($lines > $this->get('number_of_lines'))
            $lines=$this->get('number_of_lines');        
        $this->set('lines_processed',$lines);
        return $this;
    }
    
    function isProcessed()
    {
        return ($this->get('lines_processed')==$this->get('number_of_lines')); 
    }
    
    function getPourcentage()
    {
        return sprintf("%d",100 * $this->getProgression())."%";
    }
    
    function getLinesProcessed()
    {
        return (int)$this->get('lines_processed');
    }
    
    function hasHeader()
    {
        return ($this->get('has_header')=='YES');
    }
    
    function getProgression()
    {
        return $this->get('lines_processed') / $this->get('number_of_lines');
    }
    
    function hasUser()
    {
        return (boolean)$this->get('user_id');
    }
    
    function setUserObj($user)
    {
        $this->_user_id=$user;
        return $this;
    }
    
    function setUser($user)
    {
        $this->set('user_id',$user);
        $this->set('application',$user->get('application'));
        return $this;
    }
    function getUser()
    {
        if (!$this->_user_id)
        {
            !$this->_user_id=new User($this->get('user_id'),$this->get('application'),$this->getSite());
        }    
        return $this->_user_id;
    }
    
    function hasCampaign()
    {
        return (boolean)$this->get('site_id');
    }
    
    function getCampaign()
    {
        if (!$this->_site_id)
        {
            !$this->_site_id=new MarketingLeadsWpLandingPageSite($this->get('site_id'),$this->getSite());
        }    
        return $this->_site_id;
    }
    
    function getFormat()
    {
        if (!$this->_format_id)
        {
            !$this->_format_id=new MarketingLeadsWpFormsLeadsImportFormat($this->get('format_id'),$this->getSite());
        }    
        return $this->_format_id;
    }
    
    function getSchema()
    {
        if (!$this->schema)
        {
            $this->schema=  unserialize($this->get('columns'));
        }   
        return $this->schema;
    }
    
    function hasSchema()
    {
        return (boolean)$this->get('columns');
    }
    
    function hasLogFile()
    {
        return (boolean)$this->get('file_log');
    }
    
    function getLogFile()
    {
        if (!$this->_file_log)  
        {    
            $this->_file_log=new CsvFileObject(array(
                "path"=>$this->getFileDirectory(),
                "file"=>$this->get('file_log'),
                "url"=>url_to('marketing_leads_import_restrictive_access_log_file',array('import_file'=>$this->get('id'),'log_file'=>$this->get('file_log'))),              
            ));
        }     
        return $this->_file_log; 
    }

    function hasError()
    {
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array("import_id"=> $this->get("id")))
            ->setQuery("SELECT * FROM ".MarketingLeadsWpFormsLeadsImportErrors::getTable()." WHERE import_id='{import_id}';")
            ->makeSqlQuery();
        
        if(!$db->getNumRows())
            return FALSE;
        return TRUE;
    }
    
    function getErrors()
    {
        $errors = new mfArray();
        
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array("import_id"=> $this->get("id")))
            ->setQuery("SELECT * FROM ".MarketingLeadsWpFormsLeadsImportErrors::getTable()." WHERE import_id='{import_id}';")
            ->makeSqlQuery();

        if(!$db->getNumRows())
            return;
        
        while($item = $db->fetchObject("MarketingLeadsWpFormsLeadsImportErrors"))
        {
            $errors[$item->get('id')] = $item; 
        }
        
        return $errors;
    }
    
    function getNumberOfErrors()
    {        
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array("import_id"=> $this->get("id")))
            ->setQuery("SELECT * FROM ".MarketingLeadsWpFormsLeadsImportErrors::getTable()." WHERE import_id='{import_id}';")
            ->makeSqlQuery();
        return $db->getNumRows();
    }
       
}
