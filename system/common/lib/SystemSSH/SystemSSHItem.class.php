<?php

class SystemSSHItem {
  
     
    public function __construct($ssh,$file,$directory){
        $this->ssh=$ssh;
        $this->file=$file;      
        $this->directory=$directory=='/.'?"/":$directory;
        $this->extract();             
    } 
    
    function getSftp()
    {
        return $this->ssh;
    }    
    
    function isFile()
    {
        return $this->is_file;
    }
    
    function stat()
    {
        return ssh2_ssh_stat($this->ssh,$this->getFile());
    }
    
    protected function extract()
    {                        
        $this->is_file=is_file("ssh2.ssh://".intval($this->ssh)."/".$this->getFile());
        $data=$this->stat();              
        if ($data===false)
            return ;        
        foreach (array("size","uid","gid","mode","atime","mtime") as $field)
        {
           if (in_array($field,array('atime','mtime')))
                $this->$field=date("Y-m-d H:is",$data[$field]);
           else
                $this->$field=$data[$field];
        }
    } 
    
    function getSize()
    {
        return $this->size;
    }
    
    function getDirectory()
    {
        return $this->directory;
    }
    
    function getFile()
    {
        return $this->directory."/".$this->file;
    }
    
    function getFilename()
    {
        return $this->file;
    }
    
  /*  function getYear()
    {
        return $this->year;
    }
    
    function getMonth()
    {
        return $this->month;
    }
    
    function getDay()
    {
        return $this->day;
    }*/
    
    function isDirectory()
    {
        return !$this->isFile();
    }
    
    function getDate()
    {
        return $this->getYear()."-"."-".$this->getDay();
    }
    
    function getExtension()
    {
        return pathinfo($this->getFilename(), PATHINFO_EXTENSION); 
    }
    
    function getUid()
    {
        return $this->uid;
    }
    
     function getGid()
    {
        return $this->gid;
    }
}
