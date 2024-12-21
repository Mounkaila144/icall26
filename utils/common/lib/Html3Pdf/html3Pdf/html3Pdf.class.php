<?php

	
abstract class html3Pdf extends htmltopdf {
    
    protected $coordinates = null;
    
    public function getNumberOfPages() 
    {
        return $this->_page;
    }
    
    public function getSignatures()
    {
        return $this->signatures;
    }
}
