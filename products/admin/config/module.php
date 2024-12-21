<?php

// key=[action]
return array(
    
    "ajaxDeleteAction"=>array("mode"=>"json"),
    
    "ajaxDeleteProduct"=>array("mode"=>"json"),
    
    "ajaxDeleteTaxes"=>array("mode"=>"json"),
	
    "ajaxCopyProduct"=>array("mode"=>"json"),
	
    "ajaxDeleteNoUsedProduct"=>array("mode"=>"json"),
    
    "ajaxGenerateProductForContractAndMeeting"=>array("mode"=>"json"),
   
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
     "ajaxEnableProduct"=>array("mode"=>"json"),
    
    
);