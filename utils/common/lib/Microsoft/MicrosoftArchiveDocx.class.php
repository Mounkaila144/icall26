<?php


class MicrosoftArchiveDocx extends ZipArchive { 
    
    protected $file=null;
    
    function __construct($file) {
        $this->file=$file;        
    }
    
    function open()
    {
       return parent::open($this->file, ZipArchive::CREATE);
    }
    
     public function addDir($dir, $base="")
    {    
        $newFolder = str_replace($base, '', $dir);       
        $this->addEmptyDir($newFolder);
        if (!is_dir($dir))
          return $this;
        $dh = opendir($dir);
        while (($file = readdir($dh)) !== false) {          
            if (in_array($file,array('.','..')))
                continue;           
             if (is_dir($dir."/".$file))
             {    
                 $this->addDir($dir."/".$file, $base);             
             }
             else
             {
                 $newFile = str_replace($base, '', $dir."/".$file);
                 $this->addFile($dir."/".$file, $newFile);
             }
        }
        closedir($dh);    
        return $this;        
    }
        
    function save()
    {   
        $this->close();
        return $this;
    }
    
}

