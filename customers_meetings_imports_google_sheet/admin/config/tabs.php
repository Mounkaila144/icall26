<?php

return array(
    
    "dashboard.site"=>array(

        "dashboard-x-list-format" => array(
            "title" => "Google_Sheet_Format",
            "route"=>array("customers_meetings_imports_google_sheet_ajax"=>array("action"=>"ListPartialFormat")),
            'functions'=>array('html_options_format'=>null),
            "credentials"=>array(array('superadmin','customer_meeting_import_google_sheet_format')),
        ),
    
   
 ),
  
);