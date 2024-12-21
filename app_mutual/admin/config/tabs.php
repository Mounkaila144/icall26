<?php

return array(
    
    "dashboard-site-customers-meeting-view"=>array(
        "customer-meeting-app-mutual"=>array(
            "title"=>"Produits Mutuelle",
           "component"=>"/app_mutual/ProductsMutual",     
        ),
        "customer-meeting-app-mutual-calculation"=>array(
            "title"=>"Mutual calculation results", 
           "component"=>"/app_mutual/CalculationForViewMeeting",     
        ) 
    ),  
    
    "dashboard-site-customers-meeting-new"=>array(
        "customer-meeting-app-mutual-new"=>array(
            "title"=>"Produit Mutuelle",
            "component"=>"/app_mutual/New",     
        ) 
    ),  
    
    "dashboard.site"=>array(
             
        "dashboard-app-mutual-engine-calculation"=>array(
            "title"=>"AppMutual Calculation",
            "icon"=>"fa-umbrella",          
            "route"=>array("app_mutual_ajax"=>array("action"=>"ListMutualMeetingCalculation")),                                                                        
            "credentials"=>array(array('superadmin','admin'))
        ), 
    ),
);
