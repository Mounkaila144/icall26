<?php

return array(
  
       "meeting.new.form"=>array(
           "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setMeetingNewForm')           
       ),
    
       "meeting.form"=>array(
           "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setMeetingForm')           
       ),
    
       "meeting.change"=>array(
           "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setMeetingChange')           
       ),
    
       "contract.form"=>array(
           "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setContractForm'),           
           "app_domoprime_iso2"=>array('AppDomoprimeIsoEvents','setContractForm2'),               
       ),
    
     "contract.change"=>array(
           "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setContractChange')           ,
           "app_domoprime_iso2"=>array('AppDomoprimeIsoEvents','setContractChange2'),    
           "app_domoprime_iso_quotation"=>array('AppDomoprimeIsoEvents','checkQuotationQuotedAt')      
       ),
    
      "contracts.list.pager"=>array(                   
                  //  "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setPagerItemForContract') ,
                   "app.domoprime.iso.surfaces_from_forms"=>array("AppDomoprimeIsoEvents","getSurfacesFromFormsForPager"),
                   "app_domoprime_iso_request"=>array('AppDomoprimeIsoEvents','setPagerForContract') ,
                             ),
    
        "contract.new.form"=>array(
              "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setNewContractForm'),
              "app_domoprime_iso2"=>array('AppDomoprimeIsoEvents','setNewContractForm2')     
        ),
    
    "customers.meeting.document.form.build"=>array(
              "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setVariablesForFormDocument')           
        ),
    
    "customers.meeting.document.form.build.pdf"=>array(
              "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setVariablesForFormDocumentPdfForContract')           
        ),
    
     "customers.meeting.premeeting.document.build.pdf"=>array(
             "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setVariablesForFormDocumentPdfForMeeting"),
        ),
    
      "contract.filter.config"=>array(
            "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setFilterConfigForContract') 
      ),
       
   
    
      "customers.meeting.document.form.build.pdf"=>array(
            "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setVariablesForDocumentPdf') 
      ),
    
    "customers.meeting.document.form.build"=>array(
            "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','SetVariablesForDocument') 
      ),
    
    "contract.filter.query"=>array(
         "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','SetFilterQueryForContract') 
    ),
    
    "contract.meeting.transfert"=>array(
         "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','CheckTransfertForContract') 
    ),
    
    
        "contract.transfert.data"=>array(
               "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setDataForContractTransfer"),
        ),
    
    "meeting.transfert.data"=>array(
               "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setDataForMeetingTransfer"),
        ),
    
    "meeting.import.model"=>array(
               "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","SetImportModel"),
        ),
    
      "meeting.import.data"=>array(
               "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","SetImportData"),
        ),
    
     "contract.import.model"=>array(
               "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","SetImportModel"),
        ),
    
      "contract.import.data"=>array(
               "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","SetImportData"),
        ),
    
     'contracts.multiple.form.config'=>array(
              "app.domoprime_iso"=>array("AppDomoprimeIsoEvents","SetContractsMultipleFormConfig"),
        ),
    
        'contracts.multiple.process'=>array(
              "app.domoprime_iso_x"=>array("AppDomoprimeIsoEvents","SetContractsMultipleProcess"),
        ),
    
    'contract.export.query'=>array(
         "app.domoprime_iso"=>array("AppDomoprimeIsoEvents","SetExportQueryForContract"),
    ),
    
    'meeting.export.model'=>array(
         "app.domoprime_iso"=>array("AppDomoprimeIsoEvents","setExportModel"),
    ),
    
     "partner.communication.email.build"=>array(
         "app.domoprime_iso"=>array("AppDomoprimeIsoEvents","setVariablesForPartnerEmail"),
    ),
    
    "customers.contracts.document.build"=>array(
         "app.domoprime_iso"=>array("AppDomoprimeIsoEvents","setVariablesForDocumentContract"),
    ),
    
    "contract.master.refresh.config.form"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setFormConfigForMasterTransferContract"),
    ),
    
    "contract.master.refresh.form"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setFormForMasterTransferContract"),
    ),
    
     "meeting.master.refresh.config.form"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setFormConfigForMasterTransferMeeting"),
    ),
    
    "meeting.master.refresh.form"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setFormForMeetingTransferMeeting"),
    ),
    
    "contract.filter.kml.config"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setFilterForKmlContracts"),
    ),
    
    "contract.filter.kml.data"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setDataForKmlContracts"),
    ),
    
    "contract.filter.kml.placemark"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setPlacemarkForKmlContracts"),
    ),
    
 
      "contract.copy"=>array(
                "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","copyContract"),   
        ),
        
    "customers.contracts.document.multiple.build"=>array(
                "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setParametersForDocumentContractMultiple"),   
        ),
    
    "app_domoprime.quotation.build"=>array(
                "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setCheckerForQuotation"),   
                "app_domoprime_iso_quotation"=>array("AppDomoprimeIsoEvents","setVariablesForQuotation")
        ),
    
    "app_domoprime.iso.document.process.pdf"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setCheckerForDocument"), 
      //   "app_domoprime_iso_hold"=>array("AppDomoprimeIsoEvents","setHoldQuoteContractForDocuments"),  
    ),
    
    "app_domoprime.iso.all_documents.preprocess"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setCheckerForAllDocuments"),   
         "app_domoprime_iso_hold"=>array("AppDomoprimeIsoEvents","setHoldQuoteContractForAllDocuments"),  
    ),
    
    "app_domoprime.iso.signed_documents.preprocess"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setCheckerForAllSignedDocuments"),   
         "app_domoprime_iso_hold"=>array("AppDomoprimeIsoEvents","setHoldQuoteContractForAllSignedDocuments"),  
    ),
    
    "app_domoprime.premeeting.process.pdf"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setCheckerForPreMeeting"),   
    ),
    
    "app_domoprime.iso.contract.quotation.create"=>array(
        "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setContractHoldQuote"),   
    ),
    
     'contracts.csv.export.extended.fields'=>array(
             "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setFieldsForContractExport"),
        ),
    
    'meetings.multiple.process.done'=>array(
             "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setMultipleForMeetingTransfer"),
        ),
    
   // "meetings.multiple.process"=>array(
    //   "app.domoprime_iso"=>array("AppDomoprimeIsoEvents","SetMeetingsMultipleFormConfig"), 
  //  ),
    
    "meetings.multiple.form.config"=>array(
       "app.domoprime_iso"=>array("AppDomoprimeIsoEvents","SetMeetingsMultipleFormConfig"),  
    ),
    
      "meeting.filter.config"=>array(
       "app.domoprime_iso"=>array("AppDomoprimeIsoEvents","setFilterConfigForMeeting"),  
    ),   
    
    "meetings.list.pager"=>array(
     "app.domoprime_iso"=>array("AppDomoprimeIsoEvents","getSurfacesFromRequestMeetingForPager"),  
    ),
    
       "meeting.copy"=>array(
                "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","copyMeeting"),   
        ),
    
     "app_domoprime.afterwork.process.pdf"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setCheckerForPreMeeting"),   
    ),
    
    "app_domoprime.billing.build"=>array(
         "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setVariablesForBilling"),   
    ),
    
    'meetings.list.pager.item'=>array(
         "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setPagerItemForMeeting') 
    ),
    
    
      "contract.filter2.config"=>array(
            "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setFilter2ConfigForContract') 
      ),
    
      "contracts.list.pager2"=>array(                   
                    "app.domoprime.iso.surfaces_from_forms"=>array("AppDomoprimeIsoEvents","getSurfacesFromFormsForPager2"),
                   "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setPager2ForContract2') 
                             ),
        
      "contract.export.data.populate"=>array(
            "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setDataExport2ForContract') 
      ),
    
    "contract.export2.query"=>array(
            "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setConfigExport2ForContract') 
      ),
    
      "meetings.list.pager2"=>array(                   
                   "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setPager2ForMeeting2') 
                             ),   
    
    "meeting.new.api2.form"=>array(                   
                   "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setMeetingNewFormApi2') 
                             ),   
    
    "contract.new.api2.form"=>array(
           "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setContractForm'),           
           "app_domoprime_iso2"=>array('AppDomoprimeIsoEvents','setContractForm2'),         
    ),
    
    'contract.api2.data'=>array(
           "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setDataForContractApi2'),                  
    ),
     
    'application.hook.update'=>array(
           "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setDataForContractHook'),                  
    ),
);