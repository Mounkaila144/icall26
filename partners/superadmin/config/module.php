<?php

// key=[action]
return array(
    
    "ajaxDeletePartner"=>array("mode"=>"json"),
    
    "ajaxDeletePartnerContact"=>array("mode"=>"json"),
    
    "ajaxChangeIsActivePartner"=>array("mode"=>"json"),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);