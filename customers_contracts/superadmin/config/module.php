<?php

// key=[action]
return array(
    
    "ajaxDeleteIconStatus"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveIconStatusI18n"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteStatusI18n"=>array("mode"=>"json"),
    
    "ajaxGenerateProduct"=>array("mode"=>"json"),
    
    "ajaxCreateContributor"=>array("mode"=>"json"),
    
    "ajaxDeleteContractProduct"=>array("mode"=>"json"),
    
    "ajaxDeleteContract"=>array("mode"=>"json"),
    
    "ajaxRecycleContract"=>array("mode"=>"json"),
    
    "ExportCsvContracts"=>array("mode"=>"none","helpers"=>array('date'=>null)),
  //  "ajaxLoadModelI18nContract"=>array("mode"=>"json"),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);