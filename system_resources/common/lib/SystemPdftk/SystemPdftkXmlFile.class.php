<?php


class SystemPdftkXmlFile extends File {
    
    
    protected $fields=null;
    
    protected function getXMLHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?><xfdf xmlns="http://ns.adobe.com/xfdf/" xml:space="preserve"><fields>';
    }
    
    protected function getXMLFooter()
    {
        return '</fields></xfdf>';
    }
    
    function setFields(mfArray $fields)
    {
        $this->fields=new mfArray();
        foreach ($fields as $name=>$value)
          $this->fields[]='<field name="'.$name.'"><value>'.$value.'</value></field>';  
        return $this;
    }
    
    function getFields()
    {
       return $this->fields;    
    }
    
    function save()
    {
        $this->putContent($this->getXMLHeader().$this->getFields()->implode("\n").$this->getXMLFooter());
        return $this;
    }
}
