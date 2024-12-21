<?php
// key = [action][view]
return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
     
//    "ajaxNewFormatFromFile"=>array(
//            'helpers'=>array("number"=>null),                    
//            "security"=>array("php_functions"=>array(                                            
//                                    "format_size"=>null
//                                ),
//                        ),
//    ),
//     
    "ajaxListVersions"=>array(
        "helpers"=>array("date"=>null),
        "security"=>array("php_functions"=>array(
                            "format_date"=>null
                        ),
            ),
    ),
//     
//    // LogFile
//    "ajaxViewLog"=>array(
//        "template"=>"customers_meetings_imports_ajaxListPartialFiles.tpl"
//    ),
//    //end
//    
//    "ajaxImport"=>array(
//        'helpers'=>array("number"=>null),                    
//        "security"=>array("php_functions"=>array(                                            
//                            "format_size"=>null
//                        ),
//                    ),
//    ),
//     
//    "ajaxProcessImport"=>array(
//        'helpers'=>array( "number"=>null),   
//        'security'=>array(
//            "php_functions"=>array("format_size"=>null)
//        ),
//    ),
); 
 
