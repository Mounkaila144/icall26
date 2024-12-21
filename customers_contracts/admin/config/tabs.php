<?php

return array(
    
    "dashboard.site"=>array(
             
                "dashboard-customers-contract"=>array(
                                    "title"=>"Contracts",
                                    "icon"=>"file-text-o",                                
                                    "route"=>array("customers_contracts_ajax"=>array("action"=>"ListPartialContract")),
                                    "help"=>"help download",
                                    "credentials"=>array(array('admin','contract_list')),
                                    "picture"=>"/pictures/icons/contract.png",  
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ), 
        
        
              "customers-contract_dashboard2"=>array(
                                    "target"=>"dashboard-customers-contract",
                                    "title"=>"Contracts2",
                                    "icon"=>"file-text-o",                                
                                    "route"=>array("customers_contracts_ajax"=>array("action"=>"ListPartialContract2")),
                                    "help"=>"help download",
                                    "credentials"=>array(array('contract_list2')),
                                    "picture"=>"/pictures/icons/contract.png",  
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ),  
        
         
                "dashboard-customers-contract-dates"=>array(
                                    "title"=>"Dates",
                                    "icon"=>"calendar",                                
                                    "route"=>array("customers_contracts_ajax"=>array("action"=>"ListPartialDatesContract")),
                                    "help"=>"help download",
                                    "credentials"=>array(array('superadmin','contract_list_dates')),
                                    "picture"=>"/pictures/icons/contract.png",  
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ), 
        
          
     ),
     
    
    "dashboard-site-customers-contract-view"=>array(
        
                        "contract-10-products"=>array(
                                    "title"=>"Sold products",
                                  //  "help"=>"help categories",
                                  //  "picture"=>"/pictures/icons/category.png",  
                                    "component"=>"/customers_contracts/listProductsForContract",     
                                    "credentials"=>array(array('superadmin','admin','contract_products_list'))
                         ),
        
                        "contract-20-attributions"=>array(
                                    "title"=>"Attributions",
                                  //  "help"=>"help categories",
                                  //  "picture"=>"/pictures/icons/category.png",  
                                    "component"=>"/customers_contracts/attributions",     
                                    "credentials"=>array(array('superadmin','admin','contract_attributions_list'))
                         ),
        
                        "contract-20-attributions2"=>array(
                                    "title"=>"[Attributions]",                                 
                                    "component"=>"/customers_contracts/attributions2",     
                                    "credentials"=>array(array('superadmin','contract_attributions_list_with_team'))
                         ),
                         
                  /*      "contract-25-meeting-comments"=>array(
                                "title"=>"Comments",                     
                                "component"=>"/customers_meetings_comments/listForContract",  
                                "credentials"=>array(array('superadmin','admin','contract_meeting_comments_list'))
             ),*/
    ),
             
    
  "site.models.variables.email"=>array(
            "20-customer-contract-variables-email"=>array(
                        "title"=>"Contracts",                      
                        "component"=>"/customers_contracts/variablesEmailTab",     
             )
   ),
    
    
    "site.models.variables.installation.email"=>array(
            "customer-contract-variables-email"=>array(
                        "title"=>"Contracts",                      
                        "component"=>"/customers_contracts/variablesEmailTab",     
             )
   ),
    
      "site.models.variables.sms"=>array(
            "customer-contract-variables-sms"=>array(
                        "title"=>"Contracts",                      
                        "component"=>"/customers_contracts/variablesSmsTab",     
             )
   ),

  
);