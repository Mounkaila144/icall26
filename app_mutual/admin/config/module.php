<?php

// key=[action]
return array(
    
    /*MutualPartner*/
    "ajaxDeleteMutualPartner"=>array("mode"=>"json"),
    
    "ajaxChangeIsActiveMutualPartner"=>array("mode"=>"json"),
    
    "ajaxRemoveMutualPartner"=>array("mode"=>"json"),
    
    "ajaxDisabledStatusMutualPartner"=>array("mode"=>"json"),
    
    "ajaxEnabledStatusMutualPartner"=>array("mode"=>"json"),
    
    /*Product*/
    "ajaxDeleteMutualProduct"=>array("mode"=>"json"),
    
    "ajaxChangeIsActiveMutualProduct"=>array("mode"=>"json"),
    
    "ajaxRemoveMutualProduct"=>array("mode"=>"json"),
    
    "ajaxDisabledStatusMutualProduct"=>array("mode"=>"json"),
    
    "ajaxEnabledStatusMutualProduct"=>array("mode"=>"json"),
    
    /*Contact*/
    "ajaxDeleteMutualPartnerContact"=>array("mode"=>"json"),
    
    /*Commission*/
    "ajaxChangeIsActiveCommission"=>array("mode"=>"json"),
    
    "ajaxRemoveMutualProductCommission"=>array("mode"=>"json"),
    
    "ajaxDisabledStatusMutualProductCommission"=>array("mode"=>"json"),
    
    "ajaxEnabledStatusMutualProductCommission"=>array("mode"=>"json"),
    
    "ajaxDeleteMutualProductCommission"=>array("mode"=>"json"),
    
    /*Decommission*/
    "ajaxChangeIsActiveDecommission"=>array("mode"=>"json"),
    
    "ajaxDeleteMutualProductDecommission"=>array("mode"=>"json"),
    
    "ajaxRemoveMutualProductDecommission"=>array("mode"=>"json"),
    
    "ajaxDisabledStatusMutualProductDecommission"=>array("mode"=>"json"),
    
    "ajaxEnabledStatusMutualProductDecommission"=>array("mode"=>"json"),
    
    /* MEETING */
    "ajaxGetProductsForMutual"=>array("mode"=>"json"),
    
    "ajaxGetProductsForMutualForNewMeeting"=>array("mode"=>"json"),
    
    "ajaxGetMutualsForNewMeeting"=>array("mode"=>"json"),
    
    "ajaxDeleteMutualProductForMeeting"=>array("mode"=>"json"),
    
    /* ENGINE */
    "ajaxChangeIsActiveMutualCalculationMeeting"=>array("mode"=>"json"),
    
    "default"=>array(
        "enabled"=>true,
        "actionEnabled"=>true, 
        "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
    ),
    
);