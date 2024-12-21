<?php


class ExportCsvFilterBase {
    
    protected $filename=null,$options=array(),$handler=null,$number_of_items=0;
    
    function __construct($options=array(),$site=null) 
    {       
        $this->site=$site;
        $this->options=$options;
        $this->filename=static::getDirectory($this->site)."/".$this->getName();
       // if (($this->file=fopen($filename, "w"))===false)
       //    return;         
    }        
    
    static function getDirectory($site=null)
    {       
        if ($site)
        {    
            $site_name=($site instanceof Site)?$site->get('site_host'):mfConfig::get('mf_site_host');
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name."/data"; 
        }
        return mfConfig::get('mf_site_app_cache_dir')."/data";        
    }
    
    
    function getName()
    {
        return "file.csv";
    }
    
    function build()
    {
        
    }
    
    protected function conv($value)
    {       
       // return mb_convert_encoding($value,$this->getOption('charset_to','UTF-8'),$this->getOption('charset_from','UTF-8'));
        return $value;
    }
    
    protected function formatField($name)
    {
        return '"'.$this->conv($this->escape($name)).'"';
    }
            
    protected function escape($value="")
    {
       return str_replace('"', '""', $value); 
    }
    
    function getOption($name,$default=null)
    {
        return array_key_exists($name, $this->options)?$this->options[$name]:$default;
    }   
    
     function setOption($name,$value)
    {
        return  $this->options[$name]=$value;
    }   
    
    protected function open()
    {        
        mfFileSystem::mkdirs(dirname($this->filename));
        $this->handler=fopen($this->filename,"w+");
    }
    
    protected function close()
    {
       if ($this->handler)
           fclose ($this->handler);
    }
    
    protected function writeLine($line)
    {
        fwrite($this->handler,$line);
    }    
    
    function getFilename()
    {        
        return $this->filename;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getNumberOfItems()
    {
        return $this->number_of_items;
    }
}