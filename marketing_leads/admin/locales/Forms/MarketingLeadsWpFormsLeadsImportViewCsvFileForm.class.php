<?php

class MarketingLeadsWpFormsLeadsImportViewCsvFileForm extends mfForm {
    
    function configure() { 
        
        $this->setValidators(array(
            'Import'=> new mfValidatorInteger(),
            'Line'=> new mfValidatorInteger(),
            'Field'=> new mfValidatorString(),
        ));
    }
    
    function isErrorField($field)
    {
        return ($this->getValue("Field")==$field);
    }
    
    function isErrorLine($line)
    {
        $line = ($line + $this->getValue("Line"))-1;
        return $line==$this->getValue("Line");
    }
}