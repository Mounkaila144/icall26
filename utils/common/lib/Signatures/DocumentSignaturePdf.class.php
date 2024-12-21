<?php

class DocumentSignatureCanvas  {
    
    
    function __construct($data) {
        $this->values= new mfArray(explode(',', $data));
    }
    
    function getWidth()
    {
        return $this->getX2();
    }
    
    function getHeight()
    {
        return $this->getY2();
    }
    function getX1()
    {
       return $this->values[0] ;
    }
    
    function getY1()
    {
       return $this->values[1] ; 
    }
    
    function getX2()
    {
       return $this->values[2] ; 
    }
    
    function getY2()
    {
       return $this->values[3] ; 
    }
}

class DocumentSignaturePdf extends mfString {
    
    
    function getCanvas()
    {        
        return $this->canvas=$this->canvas===null?new DocumentSignatureCanvas($this->explode('|')):$this->canvas;
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
