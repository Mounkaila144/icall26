<?php

// key=[action]
return array(
    
    "ajaxTransferContract"=>array('mode'=>'json'),
    
    "ajaxTransferForContract"=>array('mode'=>'json'),
    
    "ajaxMigrateMeeting"=>array('mode'=>'json'),

    "ajaxDeleteOccupationI18n"=>array('mode'=>'json'),
        
    "ajaxDeleteTypeLayerI18n"=>array('mode'=>'json'),
    
    "ajaxDeleteSimulationModelI18n"=>array('mode'=>'json'),
    
     "GenerateDocumentForContract"=>array(
                            'mode'=>'none',
                             'helpers'=>array('number'=>null,"date"=>null,"string"=>null,"url"=>null),
                             "security"=>array(
                                    "php_functions"=>array(
                                                    "format_date"=>null,"format_number"=>null,'format_string'=>null,'format_string_separator'=>null
                                                   ),
                                   ),
     ),
    
    "ExportDocumentsPdf"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ExportAllDocumentsPdf"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ExportAllSignedDocumentsPdf"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ajaxTransfer"=>array('mode'=>'json'),
    
    "ajaxInstallConfiguration"=>array('mode'=>'json'),
    
    "ajaxGenerateForContract"=>array('mode'=>'json'),
    
    "ajaxInstallModels"=>array('mode'=>'json'),   
    
    "ajaxAutoSaveRequestForViewContract"=>array('mode'=>'json'),   
    
    "ajaxAutoSaveContractForViewContract"=>array('mode'=>'json'),     
    
    "ajaxSaveEnergyAffectation"=>array('mode'=>'json'),  
    
    /* ========================================================  API2 ======================================================= */
    "api2ListOccupation"=>array('mode'=>'json'),
    
    "api2ListEnergy"=>array('mode'=>'json'),
    
    "api2ListTypeLayer"=>array('mode'=>'json'),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);