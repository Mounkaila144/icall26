<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
     
     /* ========================== TypeLayer ========================================================================== */
     
         'ajaxNewTypeLayerI18n'=>array(
                                                                        
                                     'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,"format_size"=>null),),                                     
                                                      
                 ), 
     
      'ajaxSaveNewTypeLayerI18n'=>array(
                                    'template'=>"app_domoprime_iso_ajaxNewTypeLayerI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxSaveTypeLayerI18n'=>array(
                                    'template'=>"app_domoprime_iso_ajaxViewTypeLayerI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     /* ========================== OCCUPATION ========================================================================== */
     
         'ajaxNewOccupationI18n'=>array(
                                                                        
                                     'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null,"format_size"=>null),),                                     
                                                      
                 ), 
     
      'ajaxSaveNewOccupationI18n'=>array(
                                    'template'=>"app_domoprime_iso_ajaxNewOccupationI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     'ajaxSaveOccupationI18n'=>array(
                                    'template'=>"app_domoprime_iso_ajaxViewOccupationI18n.tpl",                                                                                 
                                    'helpers'=>array(
                                                "number"=>null),
                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_size"=>null),),                                     
                                                      
                 ), 
     
     
     /* ============================ S I M U L A T I O N ============================================================= */
     
     
     
     "ajaxNewSimulationForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
      "ajaxViewSimulationForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
              "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
     
      "ajaxListPartialSimulationForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
              "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
      "ajaxSaveSimulationForMeeting"=>array(
            'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
            "template"=>"app_domoprime_iso_ajaxViewSimulationForMeeting.tpl"
     ),
     
     
        "ajaxDisplaySimulationForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
     "ajaxSimulationForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
        "ajaxListSimulation"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
            "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
       "ajaxListPartialSimulation"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),      
     
     
      'ajaxSaveNewSimulationModelI18n'=>array(
                                    'template'=>"app_domoprime_iso_ajaxNewSimulationModelI18n.tpl",                                                                                 
                               
                                                      
        ), 
     
        'ajaxSaveSimulationModelI18n'=>array(
                                    'template'=>"app_domoprime_iso_ajaxViewSimulationModelI18n.tpl",                                                                                                                                                   
                                                      
        ), 
     
     "_requestForViewMeeting"=>array(
          "plugins"=>array( 'helpers'=>array('number'=>null),),
          "security"=>array(
                                    "php_functions"=>array(
                                                    "format_number"=>null
                                                   ),
                                   ),
     ),
     
      "_requestForNewMeeting"=>array(
          "plugins"=>array( 'helpers'=>array('number'=>null),),
          "security"=>array(
                                    "php_functions"=>array(
                                                    "format_number"=>null
                                                   ),
                                   ),
     ),
     
     "_requestForViewContract"=>array(
          "plugins"=>array( 'helpers'=>array('number'=>null),),
          "security"=>array(
                                    "php_functions"=>array(
                                                    "format_number"=>null
                                                   ),
                                   ),
     ),
     
      "_requestForNewContract"=>array(
          "plugins"=>array( 'helpers'=>array('number'=>null),),
          "security"=>array(
                                    "php_functions"=>array(
                                                    "format_number"=>null
                                                   ),
                                   ),
     ),
     
     
     
         "ajaxListRequest"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
            "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
       "ajaxListPartialRequest"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),    
     
     /* ================================= Q U O T A T I O N ========================================== */
     
       "ajaxNewQuotationFromRequestForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
            "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
     
      "ajaxNewQuotationFromRequestForViewMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
            "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
      "ajaxViewQuotationFromRequestForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
     "ajaxSaveQuotationFromRequestForContract"=>array(
            'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
            "template"=>"app_domoprime_iso_ajaxViewQuotationFromRequestForContract.tpl"
     ),
     
     "ajaxSaveQuotationFromRequestForMeeting"=>array(
            'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
            "template"=>"app_domoprime_iso_ajaxViewQuotationFromRequestForMeeting.tpl"
     ),
     
      "ajaxSaveQuotationFromRequestForViewMeeting"=>array(
            'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
            "template"=>"app_domoprime_iso_ajaxViewQuotationFromRequestForViewMeeting.tpl"
     ),
     
       "ajaxDisplayQuotationFromRequestForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
     
       "ajaxDisplayQuotationFromRequestForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
     
     "ajaxViewQuotationFromRequestForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
      
     "ajaxViewQuotationFromRequestForViewMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
      "ajaxNewQuotationFromRequestForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
            "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
     "ajaxListPartialQuotationFromRequestForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
                           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
      "ajaxListPartialQuotationFromRequestForViewMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
                           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
      "ajaxListPartialQuotationFromRequestForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
       "ajaxListPartialQuotationFromRequestForViewContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
      "ajaxViewQuotationFromRequestForViewContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
       "ajaxSaveQuotationFromRequestForViewContract"=>array(
            'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
            "template"=>"app_domoprime_iso_ajaxViewQuotationFromRequestForViewContract.tpl"
     ), 
     
       "ajaxNewQuotationFromRequestForViewContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
            "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
     "ajaxResultsForContract"=>array(
         'helpers'=>array('number'=>null),
          "security"=>array(
                                    "php_functions"=>array(
                                                    "format_number"=>null
                                                   ),
                                   ),
     ),
     
      "ajaxResultsForMeeting"=>array(
         'helpers'=>array('number'=>null),
          "security"=>array(
                                    "php_functions"=>array(
                                                    "format_number"=>null
                                                   ),
                                   ),
     ),
     
     
     "ajaxSettings"=>array(
         'helpers'=>array('number'=>null),
          "security"=>array(
                                    "php_functions"=>array(
                                                    "format_currency"=>null,
                                                    "format_pourcentage"=>null
                                                   ),
                                   ),
     ),
     
        
 ); 
 
