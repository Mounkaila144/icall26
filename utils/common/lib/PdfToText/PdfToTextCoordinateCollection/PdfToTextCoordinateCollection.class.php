<?php

	
class PdfToTextCoordinateCollection extends mfArray {

    public function getCoordinatesByName($name)
    {
        return $this->collection[$name];
    }
    
    public function addCoordinates($name,$coordinates)
    {
        if(empty($name))
            return;
        $this->collection[$name] = $coordinates;
        return $this;
    }
    
    public function getCoordinatesByNameInMM($name)
    {
        return $this->collection[$name]->getCoordinatesInMM();
    }
    
    public function getCoordinatesByNameInPt($name)
    {
        return $this->collection[$name]->getCoordinatesInPt();
    }
    
}
