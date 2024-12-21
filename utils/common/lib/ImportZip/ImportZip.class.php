<?php


class ImportZip extends ZipArchive { 
    
    protected $site=null,$class="",$path="";
   
    function __construct($class="",$site=null) {
        $this->class=$class;
        $this->site=$site;       
    }
   
    function getSite()
    {
       return $this->site;    
    }
    
    function getClass()
    {
         return $this->class;
    }
     
    protected function getDirectory()
    {
       return mfConfig::get('mf_site_app_cache_dir')."/data/unzip/".$this->getSite()->getHost()."/".$this->getClass()    ;
    }   
      
    protected function setPath()
    {      
      $this->path=$this->getDirectory()."/unzip_".time();  
      return $this->path;
    }  
    
    public function getPath()
    {          
      return $this->path;
    }  
    
    function extract()
    {
        mfFileSystem::mkdirs($this->getDirectory());        
        parent::extractTo($this->setPath());
    }
    
    function remove()
    {        
        if ($this->path)
        {               
           mfFileSystem::net_rmdir($this->getPath());        
        }   
    }
}

