<?php

class PartnerFileBase extends mfObject2 {
     
    protected static $fields=array('company_id','file','title','status','created_at','updated_at');
    const table="t_partners_company"; 
     protected static $foreignKeys=array('company_id'=>'Partner'); // By default
     
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
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
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
      $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
      $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
      $this->status=isset($this->status)?$this->status:"ACTIVE";

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
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('title'=>$this->get('title'),'file'=>$this->get('file'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE title='{title}' OR file='{file}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
     function getCompany()
    {
       if (!$this->_company_id)
       {
          $this->_company_id=new Partner($this->get('company_id'),$this->getSite());          
       }   
       return $this->_company_id;
    }    
   
    public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/view/data/partners/files";
    }  
    
    public function getFile()
    {
        if (!$this->get('_file'))  
        {    
            $this->_file=new fileObject2(array(
                 "path"=>$this->getFileDirectory(),
                 "file"=>$this->get('file'),
                 "urlAdmin"=>url_to('partners_file_download',array('site'=>$this->getSite()->getHost(),"file"=>$this->get('file'))), 
                 "url"=>url_to('partners_file_download',array("file"=>$this->get('file'))),    
             ));
        }     
      return $this->_file; 
    } 
    
     public function deleteFile()
    {
        $this->getFile()->remove(); 
        $this->set('file','');
        $this->save();
    }
    
    protected function _renameFile($name)
    {        
        if (!$this->get('file'))
            return ;
        $new_file=self::getName($name).".".$this->getFile()->getExtension();
        if ($new_file!=$this->get('file'))
        {  
            $this->getFile()->rename($new_file);
            $this->setFile($new_file);           
        }
    }
    
     public function renameFile()
    {        
        if ($this->hasPropertyChanged('title') && $this->get('file'))
        {    
           $this->_renameFile($this->get('title'));         
        }
    } 
    
    function setFile($file)
    {
         $this->set('file',$file);
         unset($this->_file);
         return $this;
    }
    
    function setFilename($filename)
    {
       $this->set('file',self::getName($filename));
       return $this->get('file');
    }
}
