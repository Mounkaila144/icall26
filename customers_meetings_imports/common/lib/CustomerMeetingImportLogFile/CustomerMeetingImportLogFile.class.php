<?php

	
class CustomerMeetingImportLogFile extends File {
     
    protected $header=array(),$line=array(),$has_header,$read_header=false;
    
    public static function getlogFileName()
    {
        return "log.csv";
    }
    
    function writeInLog($data)
    {
        $data .= "\n";
        $this->write($data);
    }
    
    function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }
    
    function addToHaders($col)
    {
        $this->header[] = $col;
        return $this;
    }
    
    function setLine($line)
    {
        $this->line = $line;
        return $this;
    }
    
    function addToLine($col)
    {
        $this->line[] = $col;
        return $this;
    }
    
    function writeHeader($header=array(),$cols_to_add=array())
    {
        $header = array_merge($header,$cols_to_add);
        $this->writeInLog(implode(";", $header));
    }
    
    function writeLine($line=array(),$cols_to_add=array())
    {
        $line = array_merge($line,$cols_to_add);
        $this->writeInLog(implode(";", $line));
    }
    
    function readLines()
    {
        $lines = file($this->getFile());
        foreach ($lines as $index=>$line)
        {
            if($this->has_header && !$this->read_header)
            {
                echo "<thead><tr class='list-header'>"; $this->displayLine($line,true); echo "</tr></thead>";
                $this->read_header = true;
            }
            else
            {
                echo "<tr>"; $this->displayLine($line); echo "</tr>";
            }
//            echo "<pre>"; var_dump(explode($separator, $line)); echo "</pre>";
        }
    }
    
    function setHasHeader($value=false)
    {
        $this->has_header = $value;
    }
    
    function hasHeader()
    {
        return $this->has_header;
    }
    
    function displayLine($line,$is_header=false,$separator=";")
    {
        $line_as_array = explode($separator, $line);
        
        foreach ($line_as_array as $num=>$field)
        {
            if($is_header)
                echo  "<th style='display: table-cell;'>".$field."</th>";
            else
                echo "<td>".$field."</td>";
        }
    }
}
