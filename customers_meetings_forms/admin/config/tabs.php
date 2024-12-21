<?php

return array(
    
   "dashboard-site-customers-meeting-new"=>array(
            "customer-meeting-informations"=>array(
                        "title"=>"Informations",
                      //  "help"=>"help categories",
                      //  "picture"=>"/pictures/icons/category.png",  
                        "credentials"=>array(array('superadmin','meeting_new_meeting_forms')),
                        "component"=>"/customers_meetings_forms/new",     
             ) 
    ),  

    "dashboard-site-customers-meeting-view"=>array(
            "customer-a-informations"=>array(
                        "title"=>"Informations",
                      //  "help"=>"help categories",
                        "picture"=>"/pictures/icons/category.png",  
                        "credentials"=>array(array('superadmin','meeting_view_meeting_forms')),
                        "component"=>"/customers_meetings_forms/view",     
             ),
        
        
         /*   "customer-a-informations-viewer"=>array(
                        "title"=>"Links",
                      //  "help"=>"help categories",
                      //  "picture"=>"/pictures/icons/category.png",  
                      //  "component"=>"/customers_meetings_forms/viewer", 
                        "route_ajax"=>array('customers_meeting_forms_ajax'=>array('action'=>'Viewer')),
                        "credentials"=>array(array('superadmin','admin','contract_meeting_forms_viewer'))
             )*/
   ),

      "site.models.variables.email"=>array(
            "meeting-form-variables-email"=>array(
                        "title"=>"Form",                      
                        "component"=>"/customers_meetings_forms/variablesEmailTab",     
             )
   ),        
    
    "site.models.variables.sms"=>array(
            "meeting-form-variables-sms"=>array(
                        "title"=>"Form",                      
                        "component"=>"/customers_meetings_forms/variablesEmailTab",     
             )
   ),
    
      "site.models.variables.meeting.document"=>array(
            "meeting-form-variables-document"=>array(
                        "title"=>"Form",                      
                        "component"=>"/customers_meetings_forms/variablesEmailTab",     
             )
   ),
    
     "product.document.variables"=>array(
            "product_document_variables_z_forms"=>array(
                        "title"=>"Form",                      
                        "component"=>"/customers_meetings_forms/variablesEmailTab",     
             )
   ),
    
 /*  "dashboard-site-customers-meeting-view"=>array(
            "customer-a-informations2"=>array(
                        "title"=>"Informations2",
                      //  "help"=>"help categories",
                        "picture"=>"/pictures/icons/category.png",  
                        "component"=>"/customers_meetings_forms/view2",     
             )
   ),*/
    
      "dashboard-site-customers-meeting-exports-dictionary"=>array(
            "10-meeting-form-export-dictionary"=>array(
                        "title"=>"Form",                      
                        "component"=>"/customers_meetings_forms/dictionaryExportTab",     
             )
   ),
    
      "dashboard-site-customers-contract-exports-dictionary"=>array(           
          
               "10-meeting-form-export-dictionary"=>array(
                        "title"=>"Form",                      
                        "component"=>"/customers_meetings_forms/dictionaryExportTab",     
             )
   ),
    
    
    
     "dashboard-site-customers-contract-view"=>array(                               
        
                        "contract-15-forms"=>array(
                                    "title"=>"Informations",
                                  //  "help"=>"help categories",
                                  //  "picture"=>"/pictures/icons/category.png",  
                                    "component"=>"/customers_meetings_forms/viewForContract",     
                                    "credentials"=>array(array('superadmin','admin','contract_meeting_forms'))
                         )
    ),
    
       "site.models.variables.installation.email"=>array(
            "meeting-form-variables-email"=>array(
                        "title"=>"Form",                      
                        "component"=>"/customers_meetings_forms/variablesEmailTab",     
             )
   ),
    
    
     "dashboard-site-customers-contract-new"=>array(
            "customer-contract-informations"=>array(
                        "title"=>"Informations",                     
                        "component"=>"/customers_meetings_forms/NewContract",  
                        "credentials"=>array(array('superadmin_debugX','contract_new_forms'))
             ) 
    ),  

    
       "site.models.variables.contract.document"=>array(
            "meeting-form-variables-document"=>array(
                        "title"=>"Form",                      
                        "component"=>"/customers_meetings_forms/variablesEmailTabForContract",     
             )
   ),
    
    
    'customer-contract-dialog-view'=>array(
        "contract-15-forms"=>array(
                                    "title"=>"Informations",
                                  //  "help"=>"help categories",
                                  //  "picture"=>"/pictures/icons/category.png",  
                                    "component"=>"/customers_meetings_forms/viewForContract",     
                                    "credentials"=>array(array('superadmin','admin','contract_meeting_forms'))
                         )
  )
);