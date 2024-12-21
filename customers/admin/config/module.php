<?php

// key=[action]
return array(
    
   "ajaxPhoneToMobileProcess"=>array("mode"=>"json"),
    
    "ajaxDeleteUnionI18n"=>array("mode"=>"json"),
    
    "ajaxCoordinateCalculation"=>array("mode"=>"json"),
    
    "ajaxGenerateCoordinates"=>array("mode"=>"json"),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);