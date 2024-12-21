<?php

// key=[action]
return array(
    
    "ajaxDeleteIconStatus"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveIconStatusI18n"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteStatusI18n"=>array("mode"=>"json"),
    
    "ajaxConfirmMeeting"=>array("mode"=>"json"),
    
    "ajaxCancelMeeting"=>array("mode"=>"json"),
    
    "ajaxDeleteMeetingProduct"=>array("mode"=>"json"),
    
    "ajaxDeleteMeeting"=>array("mode"=>"json"),
    
    "ajaxRecycleMeeting"=>array("mode"=>"json"),
        
    "ExportCsvMeetings"=>array("mode"=>"none","helpers"=>array('date'=>null)),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);