<?php


class TimestampFormatter extends Timestamp {
    
    
     function getFormatted($format=array('d','q'))
    {
        return format_date($this->toDate(),$format);       
    }
    
    
}
