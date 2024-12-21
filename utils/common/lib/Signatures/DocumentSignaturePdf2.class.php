<?php

class DocumentSignatureCanvas2  {
    
    
    function __construct($data) {
        $this->values= new mfArray(explode(',', $data));
    }
    
   
    function getRatio()
    {
       return floatval($this->values[0]) / 100;
    }
    
    function getX()
    {
       return $this->values[1] ; 
    }
    
    function getY()
    {
       return $this->values[2] ; 
    }
    
   
}

class DocumentSignaturePdf2 extends mfString {
    
    
    function getCanvas()
    {        
        return $this->canvas=$this->canvas===null?new DocumentSignatureCanvas2($this->explode('|')):$this->canvas;
    }
    
    function getPage()
    {
        $value=$this->explode('|');
        if ($value[1])
            return intval($value[1]);
        return 1;
    }
    
   /* function toArray()
    {
        $values=array();       
        $values['page']=$this->getPage();
        $values['position']=$this->getCoordinates();       
        return $values;
    }*/
    
    function getID()
    {
        return md5($this->getValue());
    }
}
