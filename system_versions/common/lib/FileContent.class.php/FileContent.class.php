<?php

class FileContent extends File {
    
    protected $schema=array();
    
    function readFileAsTab($delimiter="|",$schema=array("module","changes"))//add schema in construct
    {
        $this->schema=$schema;
        $this->open();                   
        $rows = new mfArray();        
        foreach($this->readFileAsArray() as $line)
        {            
            if($this->displayLineFromSchema(explode($delimiter, $line)))
                $rows[] = $this->displayLineFromSchema(explode($delimiter, $line));
        }        
        $this->close();
        return $rows;
    }
    
    function displayLineFromSchema($line)
    {
        $data = null;
        foreach ($this->schema as $index=>$field)
        {
            if(!empty(trim($line[$index])))
                $data[$field] = trim($line[$index]);
        }
        if($data==null)
            return $data;
        $data["version"] = $this->getFileName();
        $data["date_version"] = $this->getDate();
        return $data;
    }
    
    function readFileAsArray()
    {
        return file($this->getFile());
    }
}
