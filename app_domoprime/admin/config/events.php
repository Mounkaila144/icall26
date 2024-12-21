<?php

return array(
  
        "contract.meeting.transfert"=>array(
               "app.domoprime"=>array("AppDomoprimeEvents","meetingTransfert"),
               "domoprime_last_quotation"=>array("AppDomoprimeEvents","meetingTransferLastQuotation")
        ),
    
        "contract.export.query"=>array(
               "app.domoprime"=>array("AppDomoprimeEvents","SetExportQueryForContract"),
        ),
    
         "meeting.export.model"=>array(
               "app.domoprime"=>array("AppDomoprimeEvents","SetExportModel"),
        ),
    
        'contracts.multiple.form.config'=>array(
              "app.domoprime"=>array("AppDomoprimeEvents","SetContractsMultipleFormConfig"),
        ),
    
        'contracts.multiple.process'=>array(
              "app.domoprime"=>array("AppDomoprimeEvents","SetContractsMultipleProcess"),            
              "app.domoprime.quotation"=>array("AppDomoprimeEvents","setQuotationsForMultipleContract"),          
        ),
    
        'customers.meeting.document.form.build'=>array(
              "app.domoprime"=>array("AppDomoprimeEvents","SetVariablesForFormDocument"),
        ),
      
      
        "contract.document.multiple.export.form.config"=>array(
             "app.domoprime"=>array("AppDomoprimeEvents","multipleDocumentExport"),
        ) ,
    
         "contract.change"=>array(
               "app.domoprime"=>array("AppDomoprimeEvents","contractChange"),
               "app.domoprime.opened_at"=>array("AppDomoprimeEvents","meetingChangeOpenedAt"),
                             ), 
    
     /*    "meeting.change"=>array(
                    "app.domoprime"=>array("AppDomoprimeEvents","meetingChange"),
                             ), */
        "meeting.change"=>array(             
                    "contract_opened_at"=>array("AppDomoprimeEvents","meetingChangeOpenedAt"),                 
        ), 
    
         "contracts.list.pager"=>array(
                    "app.domoprime.surfaces"=>array("AppDomoprimeEvents","getSurfacesForPager"),
                    "app.domoprime.qmac"=>array("AppDomoprimeEvents","getQmacForPager"),
                    "app.domoprime.surfaces_from_forms"=>array("AppDomoprimeEvents","getSurfacesFromFormsForPager"),
                    "app.domoprime.quotation.yousign"=>array("AppDomoprimeEvents","getQuotationSIgnatureForPager"),
                    "app.domoprime.document.yousign"=>array("AppDomoprimeEvents","getQuotationSIgnatureForPager"),
                             ),
    
        "meeting.document.form.build.values"=>array(
             "customer.meeting.forms"=>array("AppDomoprimeEvents","DocumentParametersBuildFormValuesForContract"),
        ),
    
        "customers.meeting.document.form.build.pdf"=>array(
             "app_domoprime"=>array("AppDomoprimeEvents","SetVariablesForFormDocumentPdf"),
        ),
    
       "customers.contract.document.build.pdf"=>array(
             "app_domoprime"=>array("AppDomoprimeEvents","SetVariablesForFormDocumentPdf"),       
        ),
    
        "customers.meeting.premeeting.document.build.pdf"=>array(
             "app_domoprime"=>array("AppDomoprimeEvents","SetVariablesForFormDocumentPdfForMeeting"),
        ),
    
        "meeting.form.document.generation.pdf"=>array(
             "app_domoprime"=>array("AppDomoprimeEvents","MeetingFormDocumentPdfArchive"),
        ),
    
        "meeting.form.update"=>array(
             "app_domoprime"=>array("AppDomoprimeEvents","MeetingFormUpdate"),
        ),
    
        "contract.customer.address"=>array(
             "app_domoprime"=>array("AppDomoprimeEvents","CustomerAddressUpdateForContract"),
        ),
    
        "contract.filter.config"=>array(
            "app_domoprime"=>array("AppDomoprimeEvents","setFilterForContract"),
            "app_domoprime_export"=>array("AppDomoprimeEvents","setFilterOptionsForContractExport"),
            "app_domoprime_quotation"=>array("AppDomoprimeEvents","setFilterQuotationForContract"),
            "app_domoprime_quotation_date"=>array("AppDomoprimeEvents","setQuotationDateFilterForContract"),
            
        ),
    
        "app_domoprime.quotation.build"=>array(
            "app_domoprime"=>array("AppDomoprimeEvents","setVariablesForQuotation"),
        ),
    
        "customers.contracts.exports.options.config"=>array(
            "app_domoprime"=>array("AppDomoprimeEvents","setOptionsForContractsExport"),
        ),
    
     /*   'contract.filter.query'=>array(
            "app_domoprime"=>array("AppDomoprimeEvents","setFilterQueryQuotationForContract"),
        ) */
    
     'contract_export_installer_validation'=>array(
                "contracts"=>array("AppDomoprimeEvents","setValidateInstallerExport"),   
        ),
    
        'contracts.csv.export.extended.fields'=>array(
             "app_domoprime"=>array("AppDomoprimeEvents","setFieldsForContractExport"),
        ),
    
    
    'meetings.multiple.process'=>array(
             "app_domoprime"=>array("AppDomoprimeEvents","setMultipleForMeeting"),
        ),
    
    'meetings.multiple.process.done'=>array(
         "app_domoprime_done"=>array("AppDomoprimeEvents","setQuotationsForMultipleMeeting"),        
    ),
    
  /*  'product.new'=>array(
         "app_domoprime_done"=>array("AppDomoprimeEvents","setProductForContractAndMeeting"),        
    ),*/
    
     'product.update'=>array(
         "app_domoprime_done"=>array("AppDomoprimeEvents","setProductForContractAndMeeting"),        
    ),
    
    "contracts.list.pager2"=>array(
        "app_domoprime"=>array("AppDomoprimeEvents","setPartnerLayersForPager2"),        
    ), 
    
     "contract.export.data.populate"=>array(
             "app_domoprime"=>array('AppDomoprimeEvents','setDataExport2ForContract'), 
             "app_domoprime_with_cumac"=>array('AppDomoprimeEvents','setDataExport2CumacForContract') ,
            "app_domoprime_with_details"=>array('AppDomoprimeEvents','setDataExport2DetailsForContract') 
      ),
    
     "contract.filter2.config"=>array(
            "app_domoprime"=>array("AppDomoprimeEvents","setFilterForContract"),
            "app_domoprime_export"=>array("AppDomoprimeEvents","setFilterOptionsForContractExport"),
           "app_domoprime_quotation"=>array("AppDomoprimeEvents","setQuotationFilterForContract"),
         "app_domoprime_quotation_date"=>array("AppDomoprimeEvents","setQuotationDateFilterForContract"),
         //   "app_domoprime_quotation"=>array("AppDomoprimeEvents","setFilterQuotationForContract"),
        ),
    
    
    "contract.export.subquery_config"=>array(
           // "app_domoprime"=>array("AppDomoprimeEvents","setFilterForContract"),
            "app_domoprime_export"=>array("AppDomoprimeEvents","setSubQueryForContractExport2"),
         //   "app_domoprime_quotation"=>array("AppDomoprimeEvents","setFilterQuotationForContract"),
        ),
    
    "contract.to_contract"=>array(          
            "app_domoprime_calculation"=>array("AppDomoprimeEvents","setCalculationForContractTransfer"),      
            "app_domoprime_quotation"=>array("AppDomoprimeEvents","setQuotationForContractTransfer"),        
    ),
    
    
     "contract.quotation.update"=>array(
             //  "customer.meeting.forms"=>array("AppDomoprimeEvents","setHoldForSignedContract"),
               "app.domoprime"=>array("AppDomoprimeEvents","UnholdFormsForQuotationForContract"),
              "app.domoprime.customer.meeting.forms.update"=>array("AppDomoprimeEvents","UnholdFormsForQuotation"),
           "app.domoprime_quotation"=>array("AppDomoprimeEvents","UpdateBillingFromLastQuotation"),
        ),  
    
      
    
    
     "contract.quotation.new"=>array(
            "app.domoprime"=>array("AppDomoprimeEvents","UnholdFormsForQuotationForContract"),
            "app.domoprime_quotation"=>array("AppDomoprimeEvents","UpdateBillingFromLastQuotation"),
        ),
    
     "meeting.quotation.update"=>array(
              "app.domoprime.customer.meeting.forms.update"=>array("AppDomoprimeEvents","UnholdFormsForQuotationForMeeting"),
            
        ),  
     "meeting.quotation.new"=>array(
            "app.domoprime"=>array("AppDomoprimeEvents","UnholdFormsForQuotationForMeeting"),
        ),
);