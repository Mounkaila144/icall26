<?php

return array(
    "ajaxGetSheet"=>array('mode'=>'json'),
    "ajaxGetSheetHeaders"=>array('mode'=>'json'),
    "ajaxDeleteFile"=>array('mode'=>'json'),

    "siteNotAvailable" => array("always_access" => true),

    "callback"=>array("always_access"=>true),

    "ajaxLogout"=>array('mode'=>'json'),

    "default" => array(
        "enabled" => true,
        "actionEnabled" => true,
        "mode" => 'mixed',  // mixed : smarty View/Cache  | file: fichier  | uri
    ),

);


