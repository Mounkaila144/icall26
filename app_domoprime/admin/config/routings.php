<?php

return array(
    "app_domoprime"=>array("pattern"=>'/applications/domoprime/admin/{action}',"module"=>"app_domoprime","action"=>"{action}","requirements"=>array("action"=>".*")),
    "app_domoprime_ajax"=>array("pattern"=>'/module/site/applications/domoprime/admin/{action}',"module"=>"app_domoprime","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    
    
    "app_domoprime_billings_file"=>array("pattern"=>'/applications/domoprime/billings/{file}',
                                    "requirements"=>array(                                                        
                                                          "file"=>"[a-zA-Z0-9_\.\-]+",                                                         
                                                         ),
                                    "module"=>"app_domoprime",                               
                                    "action"=>"ExportBillingsPdfFile",
                                    "parameters"=>array("file"=>"{file}")
          ),
    
     "app_domoprime_polluter_document_file"=>array("pattern"=>'/iso/contracts/documents/forms/polluter/{contract}/{document}/{file}',
                                    "requirements"=>array(                                                       
                                                          "file"=>"[a-zA-Z0-9_\.\-]+",   
                                                          "contract"=>"[0-9]+",
                                                          "document"=>"[0-9]+"
                                                         ),
                                    "module"=>"app_domoprime",                               
                                    "action"=>"documentPolluterForContract",
                                    "parameters"=>array("file"=>"{file}","contract"=>"{contract}","document"=>"{document}")
          ),
    
    
     "app_domoprime_document_file"=>array("pattern"=>'/iso/contracts/documents/forms/{contract}/{document}/{file}',
                                    "requirements"=>array(                                                       
                                                          "file"=>"[a-zA-Z0-9_\.\-]+",   
                                                          "contract"=>"[0-9]+",
                                                          "document"=>"[0-9]+"
                                                         ),
                                     "module"=>"app_domoprime",                                     
                                    "action"=>"file",
                                    "parameters"=>array("file"=>"{file}","contract"=>"{contract}","document"=>"{document}")
          ),
    
    
     "app_domoprime_document_file_class"=>array("pattern"=>'/iso/contracts/documents/forms/class/{contract}/{file}',
                                    "requirements"=>array(                                                       
                                                          "file"=>"[a-zA-Z0-9_\.\-]+",   
                                                          "contract"=>"[0-9]+",                                                         
                                                         ),
                                     "module"=>"app_domoprime",                                     
                                    "action"=>"fileWithClass",
                                    "parameters"=>array("file"=>"{file}","contract"=>"{contract}")
          ),
    
    
     "app_domoprime_polluter_document_file_class"=>array("pattern"=>'/iso/contracts/documents/forms/class/polluter/{contract}/{file}',
                                    "requirements"=>array(                                                       
                                                          "file"=>"[a-zA-Z0-9_\.\-]+",   
                                                          "contract"=>"[0-9]+",                                                        
                                                         ),
                                    "module"=>"app_domoprime",                               
                                    "action"=>"documentPolluterWithClassForContract",
                                    "parameters"=>array("file"=>"{file}","contract"=>"{contract}")
          ),
    
      "app_domoprime_api2"=>array("pattern"=>'/api/v2/applications/iso/admin/{action}',"module"=>"app_domoprime","action"=>"api2{action}","requirements"=>array("action"=>".*")),
);

