<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
     
      "ajaxSaveNewModelI18nForPolluter"=>array(
           "template"=>"partners_polluter_ajaxNewModelI18nForPolluter.tpl"
      ),
    
     
     "ajaxSaveModelI18nForPolluter"=>array(
           "template"=>"partners_polluter_ajaxViewModelI18nForPolluter.tpl"
      ),
    
     
      'ajaxNewPDFModelI18nForPolluter'=>array(                                                                                       
                                     'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
     ), 
     
     'ajaxSaveNewPDFModelI18nForPolluter'=>array(
                                    'template'=>"partners_polluter_ajaxNewPDFModelI18nForPolluter.tpl",                                                                                 
                                'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),   
                                                      
        ), 
     
       'ajaxViewPDFModelI18nForPolluter'=>array(                                                                                       
                                     'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
     ), 
        'ajaxSavePDFModelI18nForPolluter'=>array(
                                    'template'=>"partners_polluter_ajaxViewPDFModelI18nForPolluter.tpl",                                                                                                                                                   
                                                      
        ),  
     
     
     "pdfPreviewModelForPolluter"=>array(
                                   'helpers'=>array('number'=>null,"date"=>null,"string"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null,'format_string'=>null,'format_string_separator'=>null
                                                   ),
                                   ),
     ),
     
     "ajaxSaveDocumentForPolluter"=>array(
          'template'=>"partners_polluter_ajaxViewDocumentForPolluter.tpl",  
     ),
     
     "ajaxSaveRecipientCompany"=>array(
         "template"=>"partners_polluter_ajaxViewRecipientCompany.tpl"
     ) ,
     
      'ajaxImportPDFArchiveForPolluter'=>array(
         'helpers'=>array(
             "date"=>null,"number"=>null),
         'security'=>array(
             "php_functions"=>array(
                 "format_size"=>null),),

     ), 
     
     
     'ajaxUploadImportPDFArchiveForPolluter'=>array(
          'template'=>'partners_polluter_ajaxImportPDFArchiveForPolluter.tpl',
         'helpers'=>array(
             "date"=>null,"number"=>null),
         'security'=>array(
             "php_functions"=>array(
                 "format_size"=>null),),
     ),
     
     
     
       'ajaxNewDocModelI18nForPolluter'=>array(                                                                                       
                                     'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
     ), 
     
     'ajaxSaveNewDocModelI18nForPolluter'=>array(
                                    'template'=>"partners_polluter_ajaxNewDocModelI18nForPolluter.tpl",                                                                                 
                                'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),   
                                                      
        ), 
     
       'ajaxViewDocModelI18nForPolluter'=>array(                                                                                       
                                     'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
     ), 
        'ajaxSaveDocModelI18nForPolluter'=>array(
                                    'template'=>"partners_polluter_ajaxViewDocModelI18nForPolluter.tpl",                                                                                                                                                   
                                 'helpers'=>array(
                                                "date"=>null,"number"=>null),                           
        ), 
     
       'ajaxSavePdfModelI18nForPolluter'=>array(
                                    'template'=>"partners_polluter_ajaxViewPdfModelI18nForPolluter.tpl",                                                                                                                                                   
                                 'helpers'=>array(
                                                "date"=>null,"number"=>null),                           
        ), 
     
      'ajaxViewPdfModelI18nForPolluter'=>array(                                                                                                                                                                        
                                 'helpers'=>array(
                                                "date"=>null,"number"=>null),                           
        ),
     
      'ajaxViewDocModelI18nForPolluter'=>array(                                                                                                                                                                        
                                 'helpers'=>array(
                                                "date"=>null,"number"=>null),                           
        ),
 ); 
 
