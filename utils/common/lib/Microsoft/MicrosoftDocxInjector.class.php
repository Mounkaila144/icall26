<?php


class MicrosoftDocxInjector {
   
    protected $options=null,$file=null,$errors=null,$fields=null;
    
    
    function __construct(File $file,mfArray $fields,$options=array())
    {
       $this->file=$file;               
       $this->options= new mfArray($options);     
       $this->errors=new mfArray();
       $this->fields=$fields;
    }
    
    function getDirectory()
    {
        return $this->file->getFile();
    }
    
    function getFields()
    {
        return $this->fields;
    }
    
    function save()
    {
       // echo $this->getDirectory()."/docProps/custom.xml";
         $dom  = new DOMDocument('1.0', 'utf-8' );              
         if (!$dom->load($this->getDirectory()."/docProps/custom.xml"))
                 return $this;                  
         $xpath=new DOMXPath($dom);
         $nodes=$xpath->query('*');    //   Properties 
     // echo "<pre>";   var_dump($nodes);
        foreach ($nodes as $node)
        {
            if ($node->getAttribute('name')=='ContentTypeId')
                continue;
           $name=$node->getAttribute('name');
           if (!$this->getFields()->getKeys()->in($name))
               continue; 
            $node->firstChild->textContent=$this->getFields()->getItemByKey($name);
        } 
        $dom->save($this->getDirectory()."/docProps/custom.xml");                 
        return $this;
    }
}

