<?php

// key=[action] "moduleAction"= ....
return array(
    
 
    
    "ajaxSavePicture"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeletePicture"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveHeader"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteHeader"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveFooter"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteFooter"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri  | header
                    ),
    
);