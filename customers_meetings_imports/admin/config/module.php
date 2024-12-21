<?php

// key=[action]
return array(
    
    "ajaxProcessImportFileLines"=>array("mode"=>"json","helpers"=>array('date'=>'','number'=>'','url'=>'')),
        
    "ajaxDeleteFormat"=>array("mode"=>"json"),
    
    "ajaxProcessImportDirectFileLines"=>array("mode"=>"json","helpers"=>array('date'=>'','number'=>'','url'=>'')),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);