<?php


class XmlImport extends SimpleXMLElement {
                   
    protected $options=array(),$site=null,$schema=null;          
    
    protected function configure()
    {
        
    }
        
    function setSite($site)
    {        
        $this->site=$site;            
         return $this;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function debug()
    {
        $this->options['debug']=true;
    }
    
    function setOption($name,$value)
    {
        $this->options[$name]=$value;
        return $this;    
    }   
    
    function getOption($name,$default="")
    {
        return isset($this->options[$name])?$this->options[$name]:$default;
    }        
    
    protected function escape($value="")
    {
        return str_replace('"', '""', $value); 
    }
    
//    function getDataFromXML()
//    {
//        $values = array();
//        $values['name'] = (string)$this->format->name;
//        foreach($this->format->column as $column){
//            $values['columns'][] = array('title'=>(string)$column['title'],'name'=>(string)$column['name'],
//                                    'position'=>(int)$column['position'],'index'=>(int)$column['index']);
//        }
//        return $values;
//    }
    
    function getOptions()
    {
        return $this->options;
    }
    
    function setSchema($schema)
    {
        $this->schema=$schema;
        return $this;
    }

    function hasSchema()
    {
        return (boolean)$this->schema;
    }
                    
}

