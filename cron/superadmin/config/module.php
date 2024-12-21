<?php

// key=[action]
return array(
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    "ajaxReportDelete"=>array("mode"=>"json"),
    
    "ajaxDeleteCron"=>array("mode"=>"json"),
    
    "ajaxDeleteDatabase"=>array("mode"=>"json"),
    
    "ajaxChangeCron"=>array("mode"=>"json"),
    
    "ajaxDeleteCacheCron"=>array("mode"=>"json"),
    
    "ajaxClearLastExecutionCron"=>array("mode"=>"json"),
    
    "ajaxExecute"=>array("mode"=>"json"),
);