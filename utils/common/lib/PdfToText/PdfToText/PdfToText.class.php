<?php

	
abstract class PdfToText {
    
    protected $coordinates = null;
    
    public function getTotalPages() 
    {
        return $this->_page;
    }
    
    public function getCoordinates()
    {
        return $this->coordinates;
    }
}
