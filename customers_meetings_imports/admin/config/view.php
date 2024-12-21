<?php
// key = [action][view]
return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
     
    "ajaxNewFormatFromFile"=>array(
            'helpers'=>array("number"=>null),                    
            "security"=>array("php_functions"=>array(                                            
                                    "format_size"=>null
                                ),
                        ),
    ),
     
    "ajaxSaveFormat"=>array(
        "template"=>"customers_meetings_imports_ajaxViewFormat.tpl"
    ),
     
    // LogFile
    "ajaxViewLog"=>array(
        "template"=>"customers_meetings_imports_ajaxListPartialFiles.tpl"
    ),
    //end
    
    "ajaxImport"=>array(
        'helpers'=>array("number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                            "format_size"=>null
                        ),
                    ),
    ),
     
    "ajaxProcessImport"=>array(
        'helpers'=>array( "number"=>null),   
        'security'=>array(
            "php_functions"=>array("format_size"=>null)
        ),
    ),
    
     "ajaxImportDirect"=>array(
        'helpers'=>array("number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                            "format_size"=>null
                        ),
                    ),
    ),
    
     "ajaxProcessImportDirect"=>array(
        'helpers'=>array("number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                            "format_size"=>null
                        ),
                    ),
    ),
); 
 
