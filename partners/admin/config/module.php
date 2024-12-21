<?php

// key=[action]
return array(
    
    "ajaxDeletePartner"=>array("mode"=>"json"),
    
    "ajaxDeletePartnerContact"=>array("mode"=>"json"),
    
    "ajaxChangeIsActivePartner"=>array("mode"=>"json"),
    
     "ajaxSaveLogoPartner"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
     "ajaxDeleteLogoPartner"=>array("mode"=>"json"),
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);