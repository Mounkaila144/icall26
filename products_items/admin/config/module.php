<?php

// key=[action]
return array(
    
    "ajaxDeleteItem"=>array("mode"=>"json"), 
    
    "ajaxChange"=>array("mode"=>"json"), 
    
    "ajaxChangeIsDefault"=>array("mode"=>"json"), 
    
    "ExportCsvProductItems"=>array("mode"=>"none","helpers"=>array("number"=>'','date'=>'')),
    
    "ExportXMLProductItem"=>array("mode"=>"none","helpers"=>array("number"=>'','date'=>'')),
	
     "ajaxCopyProductItemWithItems"=>array("mode"=>"json"),
    
    "apiListItems"=>array('mode'=>'json','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);