<?php

return array(
    
    "dashboard.site"=>array(
             
        "dashboard-marketing-leads"=>array(
            "title"=>"Contacts",
            "icon"=>"list-ul",
            "help"=>"help marketing contacts",
//            "picture"=>"/pictures/icons/sav.jpg", 
            "route"=>array("marketing_leads_ajax"=>array("action"=>"ListWpFormsAll")),                                                                        
            "credentials"=>array(array('superadmin','admin','marketing_leads_contacts'))
        ), 
    ),

);