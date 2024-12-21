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
    
    "ExportCsvContracts"=>array("mode"=>"none","helpers"=>array('date'=>null,'number'=>null,'url'=>null)),
    
     "ExportCsvDetailContracts"=>array("mode"=>"none","helpers"=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ExportKMLContracts"=>array("mode"=>"none","helpers"=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ajaxDeleteIconInstallStatus"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveIconInstallStatusI18n"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteInstallStatusI18n"=>array("mode"=>"json"),
    
    "ajaxDeleteIconTimeStatus"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveIconTimeStatusI18n"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteTimeStatusI18n"=>array("mode"=>"json"),
    
    "ajaxGenerateCoordinatesFromFilter"=>array("mode"=>"json"),
    
    "ajaxCreateDefaultProducts"=>array("mode"=>"json"),
    
    "ajaxConfirmContract"=>array("mode"=>"json"),
    
    "ajaxUnconfirmContract"=>array("mode"=>"json"),
    
    "ajaxHoldContract"=>array("mode"=>"json"),
    
    "ajaxFreeContract"=>array("mode"=>"json"),
    
    "ajaxDeleteRangeI18n"=>array("mode"=>"json"),
    
    "ajaxCancelContract"=>array("mode"=>"json"),
    
    "ajaxUnCancelContract"=>array("mode"=>"json"),
    
    "ajaxDeleteIconOpcStatus"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveIconOpcStatusI18n"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteOpcStatusI18n"=>array("mode"=>"json"),
    
    "ajaxBlowingContract"=>array("mode"=>"json"),
    
    "ajaxUnBlowingContract"=>array("mode"=>"json"),
    
    "ajaxPlacementContract"=>array("mode"=>"json"),
    
    "ajaxUnPlacementContract"=>array("mode"=>"json"),
    
      "ajaxDeleteIconAdminStatus"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveIconAdminStatusI18n"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteAdminStatusI18n"=>array("mode"=>"json"),
    
    "ajaxHoldContractAdmin"=>array("mode"=>"json"),
    
    "ajaxFreeContractAdmin"=>array("mode"=>"json"),
    
    "ajaxDeleteConsumedProduct"=>array("mode"=>"json"),
    
    "ajaxTreatmentAttributionsProcess"=>array("mode"=>"json"),
       
    "ajaxDeleteZone"=>array("mode"=>"json"),
    
    "ajaxChangeIsActiveZone"=>array("mode"=>"json"),  
    
    "ajaxAutoSaveContractForViewContract"=>array("mode"=>"json"),  
    
    "ajaxHoldQuoteContract"=>array("mode"=>"json"),  
    
    "ajaxFreeQuoteContract"=>array("mode"=>"json"),  
    
    "ajaxChangeIsDocument"=>array("mode"=>"json"),  
    
    "ajaxChangeIsPhoto"=>array("mode"=>"json"),  
    
    "ajaxChangeIsQuality"=>array("mode"=>"json"),  
    
    "ajaxDeleteCompany"=>array("mode"=>"json"),
    
    "ajaxChangeIsActiveCompany"=>array("mode"=>"json"),  
    
    
     "ajaxSavePictureCompany"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeletePictureCompany"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveHeaderCompany"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteHeaderCompany"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveFooterCompany"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteFooterCompany"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
     "ajaxSaveStampCompany"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteStampCompany"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveSignatureCompany"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteSignatureCompany"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxChangePartner"=>array("mode"=>"json"),  
    
     /* ===================== API ============================== */
    
    "apiListContract"=>array('mode'=>'json','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "apiNewContract"=>array('mode'=>'json','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "apiSaveNewContract"=>array('mode'=>'json','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);