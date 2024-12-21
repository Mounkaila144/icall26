<?php

// key=[action]
return array(
    

    "ajaxValidRequest"=>array('mode'=>'json'),
    
    "ajaxRefuseRequest"=>array('mode'=>'json'),
  
    "ajaxGenerateForContract"=>array('mode'=>'json'),
    
    "ExportQuotationPdf"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ExportQuotationPdf2"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ExportPreMeetingDocumentPdf"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ExportPreMeetingDocumentDoc"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ExportBillingPdf"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null)),
    
    "ExportBillingExtendedPdf"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ExportBillingsPdfFile"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ExportForInstallers"=>array('helpers'=>array('date'=>null,'number'=>null)),
    
    "ajaxExportBillingsPdf"=>array('mode'=>'json','helpers'=>array('date'=>null,'number'=>null)),
    
    "ajaxExportBillingsPdfBatch"=>array('mode'=>'json'),
    
    "ajaxCreateBillingForContract"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "ajaxUpdateBillingFromLastQuotationForContract"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "ajaxDeletePollutingContact"=>array('mode'=>'json'),
    
    "ajaxDeletePolluting"=>array('mode'=>'json'),
    
    "ajaxDeletePolluterPricing"=>array('mode'=>'json'),
    
    "ajaxGetZoneFromPostcode"=>array('mode'=>'json'),
    
    "ajaxGetClassFromMeeting"=>array('mode'=>'json'),
      
    "ExportCsvQuotations"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null)),
    
    "ExportCsvBillings"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null)),
    
    "ExportCsvAssets"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null)),
    
    "ajaxRemoveQuotation"=>array('mode'=>'json'),
    
    "ajaxEnableQuotation"=>array('mode'=>'json'),
    
    "ajaxDisableQuotation"=>array('mode'=>'json'),
    
    "ExportDocumentsPdf"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ajaxGenerateDocumentsForContract"=>array('mode'=>'json','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "ajaxSendEmailBilling"=>array('mode'=>'json'),
    
    "documentPolluterForContract"=>array('helpers'=>array('number'=>null,"date"=>null,"string"=>null)),
    
    "ajaxRemovePolluting"=>array('mode'=>'json'),
    
    "file"=>array('helpers'=>array('number'=>null,"date"=>null,"string"=>null)),
        
    "fileWithClass"=>array('helpers'=>array('number'=>null,"date"=>null,"string"=>null)),
    
    "documentPolluterWithClassForContract"=>array('helpers'=>array('number'=>null,"date"=>null,"string"=>null)),
   
    "PreviewPreMeetingModel"=>array('mode'=>'none'),
    
    "ExportPreMeetingDocumentPdf"=>array('mode'=>'none','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "ajaxDeleteQuotationModelI18n"=>array('mode'=>'json'),
    
    "ajaxDeleteBillingModelI18n"=>array('mode'=>'json'),
    
    "ajaxDeleteAssetModelI18n"=>array('mode'=>'json'),
    
    "UploadImportPolluter"=>array('mode'=>'json','helpers'=>array('url'=>null)),
    
    "ajaxChangePollutingState"=>array('mode'=>'json'),      
    
    "ajaxDeleteCalculation"=>array('mode'=>'json'),    
    
    "ExportPolluterPreMeetingDocumentPdf"=>array('mode'=>'none','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "ExportPolluterPreMeetingDocumentPdfForMeeting"=>array('mode'=>'none','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "ajaxDeletePreMeetingModelI18n"=>array('mode'=>'json'), 
    
    "ajaxDeletePreMeetingModel"=>array('mode'=>'json'), 
    
    "ajaxCreateAssetForBilling"=>array('mode'=>'json'), 
    
    "ExportBillingPdf2"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null)),
    
    /* AfterWork  */
      "ExportAfterWorkDocumentPdf"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),       
    
    "ExportAfterWorkDocumentDoc"=>array('mode'=>'none','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
  
       "ajaxDeleteAfterWorkModelI18n"=>array('mode'=>'json'), 
    
    "ajaxDeleteAfterWorkModel"=>array('mode'=>'json'), 
    
    "ExportAfterWorkDocumentPdf"=>array('mode'=>'none','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
     "ExportPolluterAfterWorkDocumentPdf"=>array('mode'=>'none','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "ExportPolluterAfterWorkDocumentPdfForMeeting"=>array('mode'=>'none','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "ajaxDeleteType"=>array('mode'=>'json'), 
    
    "ajaxDeleteClassI18n"=>array('mode'=>'json'), 
    
    "ajaxRefreshQuotation"=>array('mode'=>'json'),     
    
    "api2ListQuotation"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
      "api2ListBilling"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
      "ajaxSendQuotationEmailForContract"=>array(
        "mode"=>"json",
        'helpers'=>array('number'=>null,"date"=>null,"string"=>null,"url"=>null),
       
        
        ),
    "ajaxSendQuotationEmailForMeeting"=>array(
        "mode"=>"json",
        'helpers'=>array('number'=>null,"date"=>null,"string"=>null,"url"=>null),
         
        ),
    
    /* ================================================= API ============================================================== */
    
    "api2ListPolluter"=>array('mode'=>'json'),  
    
    "api2ExportPdfQuotation"=>array('mode'=>'json','number'=>null,"date"=>null,"url"=>null),
    
    "api2ExportPdfBilling"=>array('mode'=>'json','number'=>null,"date"=>null,"url"=>null),
       
    "api2GetBilling"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "api2CreateBillingForContract"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "api2ExportPreMeetingDocumentPdf"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "api2ExportAfterWorkDocumentPdf"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),    
    
    "api2SendQuotationEmailForContract"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)), 
    
    "api2SignQuotation"=>array('mode'=>'json'), 
      
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);