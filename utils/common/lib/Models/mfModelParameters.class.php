<?php


class mfModelParameters {
    
    
    static function format_date($date)
    {        
        $values=array();
        foreach (array("ddmmyyyy"=>"a","ddmmyy"=>'d',"ddmmmmyyyy"=>"D","yyyymmdd"=>'yyyyMMdd') as $name=>$format)
        {           
            $values[$name]=format_date($date,$format);    
        }    
        return $values;
    }  
}
