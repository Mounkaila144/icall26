<?php

return array(
       "menu"=>array(                   
                        "site.dashboard"=>array(                                            
                            "childs"=>array('site_contracts'=>''),                    
                        ),                    
       ),
    
      
       "items"=>array(   // SITE MENU STRUCTURE 
           
            "site_contracts"=>array(
                   "title"=>"Customer contracts",                  
                   "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                   "enabled"=>true,
                   "childs"=>array("customers.contract.status"=>null,"customers.contract.settings"=>null),                    
               ),     
                     
            "customers.contract.status"=>array(
                         "title"=>"Contract Status",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListStatus")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",   
                      //   "module"=>"customers_contracts"
                         ),   

             "customers.contract.settings"=>array(
                         "title"=>"Settings",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"Settings")),                  
                         "picture"=>"/pictures/icons/settings.png",
                         "help"=>"modify, add and delete status",                 
                         ),   
  ),
);