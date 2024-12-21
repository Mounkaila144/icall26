<?php

// key=[action]
return array(
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
            ),
    
    /*WpLandingPageSite*/
    "ajaxDeleteWpLandingPageSite"=>array("mode"=>"json"),
    
    "ajaxChangeIsActiveWpLandingPageSite"=>array("mode"=>"json"),
    
    "ajaxDisabledStatusWpLandingPageSite"=>array("mode"=>"json"),
    
    "ajaxEnabledStatusWpLandingPageSite"=>array("mode"=>"json"),
    
    /*WpForms*/
    "ajaxDeleteWpForms"=>array("mode"=>"json"),
    
    "ajaxChangeIsActiveWpForms"=>array("mode"=>"json"),
    
    "ajaxDisabledStatusWpForms"=>array("mode"=>"json"),
    
    "ajaxEnabledStatusWpForms"=>array("mode"=>"json"),
    
    /* Recover Records */
    "ajaxPingWpLandingPageSite"=>array("mode"=>"json"),
    
    "ajaxRecoveryWpLandingPageSite"=>array("mode"=>"json"),
    
    /* IMPORT */
    "ajaxProcessImportFileLines"=>array("mode"=>"json","helpers"=>array('date'=>'','number'=>'','url'=>'')),
        
    "ajaxDeleteFormat"=>array("mode"=>"json"),
    
    /* TRANSFER */
    "ajaxMultipleTransferProcess"=>array("mode"=>"json"),
    
    "ajaxTransferToMeeting"=>array("mode"=>"json"),
    
    /* CLEAN UP */
    "ajaxCleanUp"=>array("mode"=>"json"),
    
);