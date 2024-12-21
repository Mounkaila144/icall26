<?php


class XmlFileObject extends fileObject2 {
   
    function getInformation() {
        if (!$this->information)
           $this->information=new XmlFile($this->getFile());
        return $this->information;
    }
}

