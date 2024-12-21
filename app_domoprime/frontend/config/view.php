<?php
// key = [action][view]
 return array('all'=>array('classView'=>'SmartyView',                        
                           'widgets'=>array('messages'=>null,"banner"=>null),
                          ),
       /* ===================== Z O N E  ============================================ */  
       'ajaxListPartialZone'=>array(
                            'functions'=>array('html_options_format'=>null),
                            'blocks'=>array("JqueryScriptsReady"=>null),
                       ),
   
     /* ===================== E N E R G Y============================================ */  
                                        
     
      'ajaxSaveNewEnergyI18n'=>array(
                                    'template'=>"app_domoprime_ajaxNewEnergyI18n.tpl",                                                                                 
                                                              
                                                      
                 ), 
     
     'ajaxSaveEnergyI18n'=>array(
                                    'template'=>"app_domoprime_ajaxViewEnergyI18n.tpl",                                                                                 
                                                               
                                                      
                 ), 
     
     "ajaxSaveSectorEnergyPriceForProduct"=>array(
            'template'=>'app_domoprime_ajaxViewSectorEnergyPriceForProduct.tpl'
     ),
     
     
     
     /* ===================== C L A S S ============================================ */  
    
       'ajaxNewClassI18n'=>array(
                                                                                                      
                                 'helpers'=>array('number'=>null)                                     
                                                      
                 ), 
     
     'ajaxViewClassI18n'=>array(
                                  
          'helpers'=>array('number'=>null)  
                 ), 
     
     
      'ajaxSaveNewClassI18n'=>array(
                                    'template'=>"app_domoprime_ajaxNewClassI18n.tpl",                                                                                 
                                 'helpers'=>array('number'=>null)                                     
                                                      
                 ), 
     
     'ajaxSaveClassI18n'=>array(
                                    'template'=>"app_domoprime_ajaxViewClassI18n.tpl",    
          'helpers'=>array('number'=>null)  
                 ), 
     
     'ajaxSaveRegionPriceForClass'=>array(
                                    'template'=>"app_domoprime_ajaxViewRegionPriceForClass.tpl",                                                                                                                                                                                                              
                 ), 
     
     
     /* ============================ Q U O T A T I O N ============================================================= */
     
      'ajaxSaveNewQuotationModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxNewQuotationModelI18n.tpl",                                                                                 
                               
                                                      
        ), 
     
        'ajaxSaveQuotationModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxViewQuotationModelI18n.tpl",                                                                                                                                                   
                                                      
        ), 
     
     
     "ajaxNewQuotationForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
      "ajaxViewQuotationForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
     "ajaxSaveQuotationForContract"=>array(
            'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
            "template"=>"app_domoprime_ajaxViewQuotationForContract.tpl"
     ),
     
     "ajaxSaveQuotationForMeeting"=>array(
            'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
            "template"=>"app_domoprime_ajaxViewQuotationForMeeting.tpl"
     ),
     
       "ajaxDisplayQuotationForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
     
       "ajaxDisplayQuotationForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
     
     "ajaxViewQuotationForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
      "ajaxNewQuotationForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
     "ajaxListPartialQuotationForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
                           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
      "ajaxListPartialQuotationForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
      "ajaxListQuotation"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
            "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
       "ajaxListPartialQuotation"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),      
     
      "ajaxListPartialMeetingQuotation"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),      
     
     /* ================================ B I L L I N G========================================================= */
     
      'ajaxSaveNewBillingModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxNewBillingModelI18n.tpl",                                                                                 
                               
                                                      
        ), 
     
        'ajaxSaveBillingModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxViewBillingModelI18n.tpl",                                                                                                                                                   
                                                      
        ), 
     
     
         "pdf"=>array(
                             'helpers'=>array('number'=>null,"date"=>null,"phone"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null,'format_phone'=>null
                                                   ),
                                   ),
     ),
     
     
         "pdfBilling"=>array(
                             'helpers'=>array('number'=>null,"date"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
     
        "ajaxListPartialBillingForContract"=>array(
                             'helpers'=>array('number'=>null,"date"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
          "ajaxListPartialBillingForViewContract"=>array(
                             'helpers'=>array('number'=>null,"date"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
       "ajaxListPartialBillingForMeeting"=>array(
                             'helpers'=>array('number'=>null,"date"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
       "ajaxListBilling"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),           
                                   'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null),
                                       ),     
     ),
     
       "ajaxListPartialBilling"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),            
                                   'security'=>array(
                                                     "php_functions"=>array(
                                                         "format_date"=>null),
                                       ),     
     ),
     
     
       "ajaxReport"=>array(
                             'helpers'=>array('number'=>null,'date'=>null),  
                            'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,                                                  
                                                ),
                           ), 
     ),
	 
	  /* ================================= Polluting ================================== */
     
        'ajaxSavePollutingContact'=>array(
                                    'template'=>"app_domoprime_ajaxListPollutingContact.tpl",                                                                                 
                               
                                                      
        ),
     
        'ajaxSavePolluting'=>array(
                                    'template'=>"app_domoprime_ajaxViewPollutingCompany.tpl",                                                                                 
                               
                                                      
        ),
     
          "ajaxNewPolluting"=>array(
                      'widgets'=>array('select_country'=>''),         
                      'helpers'=>array('number'=>null,'date'=>null),
                      'security'=>array(
                                   "php_functions"=>array("format_postal_code"=>'')
                                  ),
                   ),
        
            "ajaxViewPollutingCompany"=>array(
                      'widgets'=>array('select_country'=>''),   
                        'helpers'=>array('number'=>null,'date'=>null),
                      'security'=>array(
                                   "php_functions"=>array("format_postal_code"=>'')
                                  ),
                   ),
     
     
     
     "ajaxNewPricingForPolluter"=>array(
                             'helpers'=>array('number'=>null),                              
     ),
     
     "ajaxListPartialPricingForPolluter"=>array(
                             'helpers'=>array('number'=>null),                              
     ),
     
     "ajaxViewPricingForPolluter"=>array(
                             'helpers'=>array('number'=>null),                              
     ),
     
     "ajaxSavePricingForPolluter"=>array(
                             'helpers'=>array('number'=>null),    
                            'template'=>"app_domoprime_ajaxViewPricingForPolluter.tpl",             
     ),
     
     "ajaxResultsForContract2"=>array(
                             'helpers'=>array('number'=>null),  
          'security'=>array(
                                   "php_functions"=>array("format_number"=>'')
                                  ),
                                        
     ),
     
      /* ============================ A S S E T ============================================================= */
     
   /*   'ajaxSaveNewAssetModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxNewAssetModelI18n.tpl",                                                                                 
                               
                                                      
        ), 
   */  
        'ajaxSaveAssetModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxViewAssetModelI18n.tpl",                                                                                                                                                   
                                                      
        ), 
     
       "pdfAsset"=>array(
                             'helpers'=>array('number'=>null,"date"=>null,"phone"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null,'format_phone'=>null
                                                   ),
                                   ),
     ),
     
 /*    
     "ajaxNewAssetForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
      "ajaxViewAssetForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
     "ajaxSaveAssetForContract"=>array(
            'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
            "template"=>"app_domoprime_ajaxViewAssetForContract.tpl"
     ),
     
     "ajaxSaveAssetForMeeting"=>array(
            'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
            "template"=>"app_domoprime_ajaxViewAssetForMeeting.tpl"
     ),*/
     
   /*    "ajaxDisplayAssetForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),*/
     
     
    /*   "ajaxDisplayAssetForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     */
     
    /* "ajaxViewAssetForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),*/
     
    /*  "ajaxNewAssetForContract"=>array(
                        'helpers'=>array('date'=>null)
     ),*/
     
  /*   "ajaxListPartialAssetForMeeting"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),*/
     
    /*  "ajaxListPartialAssetForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),*/
     
      "ajaxListAsset"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
       "ajaxListPartialAsset"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
     
        "ajaxListPartialAssetForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
     
      "ajaxNewAssetForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null)
     ),
     
      "ajaxViewAssetForContract"=>array(
                        'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
     ),
     
     "ajaxSaveAssetForContract"=>array(
            'helpers'=>array('date'=>null,'number'=>null),
           "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),
            "template"=>"app_domoprime_ajaxViewAssetForContract.tpl"
     ),
     
     
       "emailBilling"=>array(
                  'widgets'=>array('banner'=>null),   
                  "helpers"=>array('number'=>null,"date"=>null),     
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),   
        ),
     
       "emailQuotation"=>array(
                  'widgets'=>array('banner'=>null),   
                  "helpers"=>array('number'=>null,"date"=>null),     
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null
                                                   ),
                                   ),   
        ),
     
       "ajaxStatisticOperations"=>array(
                          'blocks'=>array('JqueryScriptsReady'=>null),
                          'helpers'=>array("date"=>null,"number"=>null),
                          'security'=>array(
                                "php_functions"=>array(
                                                   "format_date"=>null,"format_number"=>null,"format_currency"=>null                                                       
                                                ),
                           ), 
       ), 
     
     
     "ajaxSaveQuotationModelForPolluter"=>array(
          'template'=>"app_domoprime_ajaxViewQuotationModelForPolluter.tpl",                
     ),
     
      'ajaxSaveFieldForDocument'=>array(
                                    'template'=>"app_domoprime_ajaxViewFieldForDocument.tpl",                                                                                                                     
     ),
     
       'ajaxSaveDocument'=>array(
                                    'template'=>"app_domoprime_ajaxViewDocument.tpl",                                                                                                                     
     ),
     
     
     'ajaxSaveRecipientForPolluter'=>array(
         'template'=>'app_domoprime_ajaxViewRecipientForPolluter.tpl'
     ),
     
     "ajaxSaveBillingModelForPolluter"=>array(
          'template'=>"app_domoprime_ajaxViewBillingModelForPolluter.tpl",                
     ),
     
     
      'ajaxSavePreMeetingModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxViewPreMeetingModelI18n.tpl",                                                                                                                                                   
                                                      
        ), 
     
     
       'ajaxNewPDFPreMeetingModelI18n'=>array(                                                                                       
                                     'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
     ), 
     
     'ajaxSaveNewPDFPreMeetingModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxNewPDFPreMeetingModelI18n.tpl",                                                                                 
                                'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),   
                                                      
        ), 
     
       'ajaxViewPDFPreMeetingModelI18n'=>array(                                                                                       
                                     'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
     ), 
        'ajaxSavePDFPreMeetingModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxViewPDFPreMeetingModelI18n.tpl",                                                                                                                                                   
                                                      
        ),  
     
     
     "pdfPreviewPreMeetingModel"=>array(
                                   'helpers'=>array('number'=>null,"date"=>null,"string"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null,'format_string'=>null,'format_string_separator'=>null
                                                   ),
                                   ),
     ),
     
     "ajaxSavePropertiesForPolluter"=>array(
         'helpers'=>array('number'=>null),
         "template"=>"app_domoprime_ajaxViewPropertiesForPolluter.tpl"
     ),
     
       "ajaxViewPropertiesForPolluter"=>array(
          'helpers'=>array('number'=>null),
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
     
      "ajaxSavePreMeetingModelForPolluter"=>array(
          'template'=>"app_domoprime_ajaxViewPreMeetingModelForPolluter.tpl",                
     ),
     
     'ajaxSaveLayerForPolluter'=>array(
         'template'=>'app_domoprime_ajaxViewLayerForPolluter.tpl'
     ),
     
     
    /* AFTER WORK */  
        'ajaxSaveAfterWorkModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxViewAfterWorkModelI18n.tpl",                                                                                                                                                   
                                                      
        ), 
     
     
       'ajaxNewPDFAfterWorkModelI18n'=>array(                                                                                       
                                     'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
     ), 
     
     'ajaxSaveNewPDFAfterWorkModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxNewPDFAfterWorkModelI18n.tpl",                                                                                 
                                'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),   
                                                      
        ), 
     
       'ajaxViewPDFAfterWorkModelI18n'=>array(                                                                                       
                                     'helpers'=>array(
                                                "date"=>null,"number"=>null),                                     
                                     'security'=>array(
                                                     "php_functions"=>array(
                                                        "format_size"=>null),),                                     
                                                      
     ), 
        'ajaxSavePDFAfterWorkModelI18n'=>array(
                                    'template'=>"app_domoprime_ajaxViewPDFAfterWorkModelI18n.tpl",                                                                                                                                                   
                                                      
        ),  
     
     
     "pdfPreviewAfterWorkModel"=>array(
                                   'helpers'=>array('number'=>null,"date"=>null,"string"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null,'format_string'=>null,'format_string_separator'=>null
                                                   ),
                                   ),
     ), 
     
     "ajaxSaveType"=>array(
          'template'=>"app_domoprime_ajaxViewType.tpl",            
     )
 ); 
 
