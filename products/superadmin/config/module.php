<?php

// key=[action]
return array(
    
    "ajaxDeleteProduct"=>array("mode"=>"json"),
    
    "ajaxDeleteAction"=>array("mode"=>"json"),
    
    "ajaxDeleteTaxes"=>array("mode"=>"json"),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);