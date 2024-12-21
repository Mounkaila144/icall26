<?php

// key=[action]
return array(
    
    "logfile"=>array("mode"=>"file"),
    
    "ajaxDeleteLog"=>array("mode"=>"json"),
    
    "ajaxDeletesLog"=>array("mode"=>"json"),
    
    "ajaxRemoveLogs"=>array("mode"=>"json"),
  //  "ajaxPreferencesSaveFavicons"=>array("mode"=>"json"),
    
  //  "ajaxPreferencesDeleteFavicon"=>array("mode"=>"json"),
    
  //  "ajaxPreferencesDeleteFaviconIco"=>array("mode"=>"json"),
    
   // "ajaxPreferencesSaveBanner"=>array("mode"=>"json"),
    
  //   "ajaxPreferencesDeleteBanner"=>array("mode"=>"json"),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);