<?php


class mfSettingsBase {
      
    protected $name=null,$data=null,$loaded=false,$modified=false,$site=null,$application=null;      
    
    static function getInstance($data=null,$site=null)
    {        
         if (!isset(static::$instance))
         {                       
             static::$instance=new static($data,$site);
         }    
         return static::$instance;
    }  
    
    static function load($site=null)
    {
        return self::getInstance(null,$site);
    }
     
    function __construct($data=null,$name=null,$application=null,$site=null)
    {
       if ($site)
           $this->site=$site;    
       if ($application)
           $this->application=$application;   
      if ($name===null)
         $this->name=get_class($this);   
      else
         $this->name=$name;
      $this->getDefaults();           
      $this->_load();
      if ($data===null)
          return;
      $this->add($data);
      $this->modified=true;
    }
    
    function set($name,$value)
    {
        if (!isset($this->data[$name]) || $this->data[$name]!=$value)        
                $this->modified=true;
        $this->data[$name]=$value;
       return $this; 
    }
    
    function getDefaults()
    {
        
    }
    
    function get($name,$default=null)
    {
        return isset($this->data[$name])?$this->data[$name]:$default;
    }
    
    function getName()
    {
        return $this->name;
    }
    
    protected function getApplication()
    {
       return ($this->application==null)?mfConfig::get('mf_app'):$this->application; 
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getSiteName()
    {       
       if ($this->site==null) 
           return mfConfig::get('mf_site_db_name');
       if ($this->site instanceof Site)
           return $this->site->getSiteName();
       throw new mfException("site is invalid.");
    }
    
    function getCacheFile()
    {
         return sprintf("%s/%s/%s/data/settings/%s.dat",
                mfConfig::get('mf_sites_dir'),
                $this->getSiteName(),
                $this->getApplication(),
                $this->getName());
    }
    
    protected function isCached()
    {
      return is_readable($this->getCacheFile());  
    }
    
    protected function _load()
    {
       $file=$this->getCacheFile();
       if (is_readable($file))
       {
           $data=file_get_contents($file);
           if ($data!==false)
           {    
               $this->loaded=true;              
               $this->data=array_merge((array)$this->data,(array)unserialize($data)); // Merge with defaults
              // $this->data=unserialize($data);              
           }
       }        
    }
    
    function save()
    {
        if ($this->data instanceof mfObject2)
        {   
            if ($this->modified!=true)
                $this->modified=($this->data->getPropertiesChanged()!=null);
            $this->data->noPropertyChanged();
        }
        
        
        if (!$this->modified && $this->loaded)
            return $this;
        
        $file=$this->getCacheFile();
        
     //   var_dump($file);
        
        if (!is_dir(dirname($file))) {
           if (false === mkdir(dirname($file), 0777, true))
                throw new mfCacheException(sprintf('Failed to make cache directory "%s".', dirname($file)));
        }       
        if (file_put_contents($file,serialize($this->data)))
              $this->loaded=true;
        else 
            $this->loaded=false;
        
         return $this;
    }
    
    function add($data)
    {
        if (is_array($data))
        {           
            foreach ($data as $name=>$value)
                $this->set($name,$value);
        }     
        else
           $this->data=$data; 
        $this->modified=true;
        return $this;
    }
    
    function isLoaded()
    {
        return $this->loaded;
    }
    
    function isNotLoaded()
    {
        return !$this->isLoaded();
    }
    
    function getData()
    {
        return $this->data;
    }
    
    function delete()
    {
       $file=$this->getCacheFile();
       if (is_readable($file))
           unlink($file);
       $this->getDefaults();      
       return $this;
    }
    
    function __set($name,$value)
    {
       return $this->set($name,$value);
    }        
    
    function __get($name)
    {
        return $this->get($name);
    }
    
    function has($name)
    {
        return isset($this->data[$name]);
    }
    
    function remove($name)
    {
        if ($this->has($name))
            unset($this->data[$name]);
        return $this;    
    }
    
    function isExist()
    {      
       return is_readable($this->getCacheFile());
    }
}

