<?php


class MicrosoftDocxExtractor2 extends MicrosoftDocxExtractor  {
   
    
    function execute()
    {    
         $zip = new ZipArchive();      
	$zip_result = $zip->open($this->getFile()->getFile());
        if ( $zip_result !== true )
            return false;       
        $zip->extractTo($this->getOutput()->getDirectory());
        $zip->close();
        return $this;
    }
    
    
}

