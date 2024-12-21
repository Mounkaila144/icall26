<?php

class MarketingLeadsWpTable {
    
    const table="mod555_contact"; 
    
    static function getTable($tab_name="")
    {
        if($tab_name==="")
            return self::table;
        else
            return $tab_name;
    }
}
