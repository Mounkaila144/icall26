<?php

class sFtpItemCollection extends mfArray {
  
    protected $directories=null,$files=null,$filenames=null;
     
     function getDirectories()
     {
         if ($this->directories===null)
         {    
             $this->directories= new sFtpItemCollection();
             foreach ($this->collection as $item)
             {    
                 if (!$item->isDirectory())
                     continue;
                 $this->directories[]=$item;
             }    
         }
         return $this->directories;
     }
     
     
     function getFiles()
     {
         if ($this->files===null)
         {    
             $this->files= new sFtpItemCollection();
             foreach ($this->collection as $item)
             {    
                 if ($item->isDirectory())
                     continue;
                 $this->files[]=$item;
             }    
         }
         return $this->files;
     }
     
     function getFilenames()
     {
         if ($this->filenames===null)
         {
            $this->filenames=new mfArray();
            foreach ($this as $item)                 
                $this->filenames[]=$item->getFilename();
         }
         return $this->filenames;
     }
     
     
     function findAndRemove($value)
     {
         foreach ($this->getKeys() as $idx)
         {           
            if ($this->collection[$idx]->getFilename() != $value)
               continue;                      
            unset($this->collection[$idx]);   
            $this->filenames=null;
         }    
         return $this;
     }
     
     function getTotalSize()
     {
         if ($this->total_size===null)
         {    
             $this->total_size=0.0;
            foreach ($this  as $item)
            {           
               $this->total_size+=$item->getSize();
            }
         }
         return $this->total_size;
     }
}
