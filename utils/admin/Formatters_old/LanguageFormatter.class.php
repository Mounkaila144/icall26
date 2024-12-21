<?php

class LanguageFormatter extends mfString {
    
    function  getFormatted($lang=null){
        
        return new mfString(format_language($this->value,$lang));
    }
    
    function getFormattedWithLanguage()
    {
        return new mfString(format_language($this->value,$this->value));
    }
}
