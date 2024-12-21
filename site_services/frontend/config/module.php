<?php
// key=[action]
// type = ECOM|CMS|null (All type)
return array(
    
    "index"=>array("mode"=>"none"
    ),
    
    
    "siteNotAvailable"=>array("always_access"=>true),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed',  // mixed : smarty View/Cache  | file: fichier  | uri
               
                    ),
    
    
);