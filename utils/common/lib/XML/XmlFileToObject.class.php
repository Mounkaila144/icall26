<?php

class XmlFileToObject extends XmlFile {
    
    protected $site=null,$file="",$object=null;
    
    function __construct($object,$path, $options = null,$site=null) {        
        $this->path=$path;
        parent::__construct($this->path."/".$this->getXmlFile(), $options);      
        $this->site=$site;      
        $this->object=$object;      
    }
    
    function getXmlFile()
    {
        throw new mfException("Invalid");
    }
     
    function getPath()
    {
        return $this->path;
    }
    
    
    function getSite()
    {
        return $this->site;
    }
    
   
    function getObject()
    {
        return $this->object;
    }
    
    function setValuesFromXML($xml)
    {
        $this->values=new mfArray(get_object_vars($xml));
        return $this;
    }
    
    function getValues()
    {
        $this->toArray();
        return $this->values;
    }
    
    function toArray()
    {
     //   echo $this->getXmlFile()."<br>";
      /*  if ($this->getXmlFile()=='pricings.xml')
                die(__METHOD__);*/
        if ($this->values===null)
        {    
            if (!file_exists($this->getFile()))
            {
                //  trigger_error('ERROR FILE'.$this->getFile());
                $this->values=false;
                return $this->values;         
            }    
            if (!$xml=simplexml_load_file($this->getFile(),'SimpleXMLElement',LIBXML_NOCDATA))
            {
              //  trigger_error('ERROR');
                $this->values=false;
                return $this->values;         
            }             
            $this->setValuesFromXML($xml);             
        }
        return $this->values;           
    }
    
    function hasValues()
    {
        return (boolean)$this->getValues();
    }
}


