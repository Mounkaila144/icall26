<?php
// key = [action][view]
return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
    
    "ajaxSaveWpLandingPageSite"=>array(
        "template"=>"marketing_leads_ajaxViewWpLandingPageSite.tpl",
    ),
    
    "ajaxNewWpForms"=>array(
        'helpers'=>array("number"=>null),  
        'functions'=>array('html_options_format'=>null),
        "security"=>array("php_functions"=>array(                                            
                                "format_country"=>null
                            ),
                       ),
    ),
    
    "ajaxSaveWpForms"=>array(
        "template"=>"marketing_leads_ajaxViewWpForms.tpl",
    ),
    
    "ajaxListWpFormsAll"=>array(
        'functions'=>array('html_options_format'=>null),
        'helpers'=>array("date"=>null,"number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                                "format_date"=>null,
                                "format_number"=>null,
                                "format_currency"=>null,
                                "format_pourcentage"=>null,
                            ),
                        ),
    ),
    
    "ajaxListPartialWpFormsAll"=>array(
        'functions'=>array('html_options_format'=>null),
        'helpers'=>array("date"=>null,"number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                                "format_date"=>null,
                                "format_number"=>null,
                                "format_currency"=>null,
                                "format_pourcentage"=>null,
                            ),
                        ),
    ),
    
    "ajaxListWpForms"=>array(
        'functions'=>array('html_options_format'=>null),
        'helpers'=>array("date"=>null,"number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                                "format_date"=>null,
                                "format_number"=>null,
                                "format_currency"=>null,
                                "format_pourcentage"=>null,
                            ),
                        ),
    ),
    
    "ajaxListPartialWpForms"=>array(
        'functions'=>array('html_options_format'=>null),
        'helpers'=>array("date"=>null,"number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                                "format_date"=>null,
                                "format_number"=>null,
                                "format_currency"=>null,
                                "format_pourcentage"=>null,
                            ),
                        ),
    ),
    
    "ajaxListRecordsByWpLandingPageSite"=>array(
        'helpers'=>array("date"=>null,"number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                                "format_date"=>null,
                                "format_number"=>null,
                                "format_currency"=>null,
                                "format_pourcentage"=>null,
                            ),
                        ),
    ),
    
    /*  EXPORT */
    "ExportCsvWpFormsLeads"=>array(
        'helpers'=>array("date"=>null,"number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                                "format_date"=>null,
                                "format_number"=>null,
                                "format_currency"=>null,
                                "format_pourcentage"=>null,
                            ),
                        ),
    ),
    
    /* IMPORT */
    "ajaxNewFormatFromFile"=>array(
        'helpers'=>array("number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                            "format_size"=>null
                        )
                    )
    ),
     
    "ajaxSaveFormat"=>array(
        "template"=>"marketing_leads_imports_ajaxViewFormat.tpl"
    ),
     
    // LogFile
    "ajaxViewLog"=>array(
        "template"=>"marketing_leads_imports_ajaxListPartialFiles.tpl"
    ),
    //end
    
    "ajaxImport"=>array(
        'helpers'=>array("number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                            "format_size"=>null
                        ),
                    )
    ),
     
    "ajaxProcessImport"=>array(
        'helpers'=>array( "number"=>null),   
        'security'=>array(
            "php_functions"=>array("format_size"=>null)
        )
    ),
     
    "_importLink"=>array(
        'blocks'=>array("JqueryScriptsReady"=>null),
        'helpers'=>array("number"=>null),   
        'security'=>array(
            "php_functions"=>array("format_size"=>null)
        ),
    ),

    /* Update Multiple */
    "ajaxMultipleProcessSelection"=>array(
        "template"=>"marketing_leads_ajaxMultipleUpdateProcess.tpl",
        'helpers'=>array("date"=>null),
                           'security'=>array(
                                   "php_functions"=>array("format_date"=>null), 
                           ),
    ),
    
    /* STATUS */
    "ajaxNewStatusI18n"=>array(
        'helpers'=>array("number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                            "format_size"=>null
                        ),
                    )
    ),
    
    "ajaxViewStatusI18n"=>array(
        'helpers'=>array("number"=>null),                    
        "security"=>array("php_functions"=>array(                                            
                            "format_size"=>null
                        ),
                    )
    ),
    
    'ajaxSaveNewStatusI18n'=>array(
        'template'=>"marketing_leads_ajaxNewStatusI18n.tpl",                                                                                 
        'helpers'=>array("number"=>null),
        'security'=>array(
                    "php_functions"=>array(
                        "format_size"=>null),),                                     

    ), 
    
    'ajaxSaveStatusI18n'=>array(
        'template'=>"marketing_leads_ajaxViewStatusI18n.tpl",                                                                                 
        'helpers'=>array("number"=>null),
        'security'=>array(
            "php_functions"=>array(
                "format_size"=>null),
            ),                                     
    ), 
    
); 
 
