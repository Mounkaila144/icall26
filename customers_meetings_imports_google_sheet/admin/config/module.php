<?php

return array(
    "ajaxImport"=>array('mode'=>'json'),
    "ajaxDeleteFormat"=>array("mode"=>"json"),
    "ajaxGetImportStatus"=>array("mode"=>"json"),
    "ajaxUpdateNumberOfLines"=>array("mode"=>"json"),
    "ajaxReset"=>array("mode"=>"json"),

    "siteNotAvailable" => array("always_access" => true),

    "default" => array(
        "enabled" => true,
        "actionEnabled" => true,
        "mode" => 'mixed',  // mixed : smarty View/Cache  | file: fichier  | uri
    ),

);


