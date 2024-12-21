<?php


return array(
        "meeting.new.form"=>array(
                    "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setNewForm"),
                             ),
    
       "meeting.form"=>array(
                    "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setViewForm"),
                             ),
       
        "meeting.change"=>array(
                   "customer.meeting.forms"=>array("CustomerMeetingFormEvents","meetingChange"),
                             ),
    
        "customers.meetings.email.build"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","EmailParametersBuildForMeeting"),
        ),
    
        "customers.meetings.sms.build"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SmsParametersBuildForMeeting"),
        ),
    
         "customers.contracts.email.build"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","EmailParametersBuildForContract"),
        ),
    
        "customers.contracts.sms.build"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","SmsParametersBuildForContract"),
        ),
    
       "customers.meetings.document.build"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","DocumentParametersBuild"),
        ),
    
        "customers.meetings.document.multiple.build"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","DocumentMultipleParametersBuild"),
        ),
    
        "customers.contracts.products.document.build"=>array(
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","DocumentParametersBuildForContract"),
        ),
    
        "app.domoprime.multi.document.build.pdf"=>array(            
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","DocumentParametersBuildPdfForContract"),
        ),
    
        "customers.meeting.document.form.build"=>array(
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","DocumentParametersBuildForContract"),
        ),
    
        "meeting.filter.config"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","FilterConfigForMeeting"),
               "customer.meeting.forms.list"=>array("CustomerMeetingFormEvents","setMeetingFilterConfig"),
        ),
    
        "meeting.filter.execute"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","FilterExecuteForMeeting"),
        ),
    
        "meeting.export.model"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SetExportModel"),
        ),
    
        "meeting.import.model"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SetImportModel"),
        ),    
    
        "meeting.import.data"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SetImportData"),
        ),
    
         "meeting.export.query"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SetExportQueryForMeeting"),
        ),
    
          "contract.export.query"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SetExportQueryForContract"),
        ),
    
         "meeting.service.query"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SetServiceQueryForMeeting"),
        ),
    
        "meeting.service.model"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SetServiceModel"),
        ),
        
        "products.installer.communication.email.build"=>array(
                 "customer.contract.forms"=>array("CustomerMeetingFormEvents","EmailParametersBuildForInstallerSchedule"),
        ),
    
        "contract.hold"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SetHold"),
        ),
    
        "contract.unhold"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SetUnHold"),
        ),
    
       "partner.communication.email.build"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","EmailParametersBuildForContract"),
        ),
    
    
        "customers.meeting.document.form.build.pdf"=>array(
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","DocumentParametersBuildPdfForContract"),
        ),
    
       "customers.contract.document.build.pdf"=>array(
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","DocumentParametersBuildPdfForContract"),
        ),
    
     "customers.contract.multi.document.build.pdf"=>array(
              "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setVariablesForWorkDocumentPdf"),                  
    ),
    
        "contract.change"=>array(
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","contractChange"),
        ),
    
        "contract.new.form"=>array(
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setNewContractForm"),
        ),
         
        "contract.form"=>array(
             "customer.meeting.forms_iso"=>array("CustomerMeetingFormEvents","setViewContractPartialForm"),         
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setViewForm"),
        ),
      
        "customers.contracts.document.build"=>array(
            "customer.meeting.forms"=>array("CustomerMeetingFormEvents","DocumentForContractParametersBuild"),
        ),
                        
        "customers.contracts.document.multiple.build"=>array(          
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","DocumentForContractsParametersBuild"),
        ),
    
    
        "meetings.multiple.process"=>array(
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SetMeetingsMultipleProcess"),
        ),
    
         "contract.import.model"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","SetImportModel"),
        ),             
    
       "contract.import.data"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","setDataForContractImport"),
        ),
    
        "contract.transfert.data"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","setDataForContractTransfer"),
        ),
    
    
         "meeting.transfert.data"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","setDataForMeetingTransfer"),
        ),
    
        "app_domoprime.quotation.build"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","setDataForQuotation"),
        ),
    
       "app_domoprime.billing.build"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","setDataForBilling"),
        ),
    
        "contract.master.refresh.form"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","setDataForContractMasterTransfer"),
        ),
    
        "contract.master.refresh.config.form"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","setFormForContractMasterTransfer"),
        ),
    
         "meeting.master.refresh.form"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setDataForMeetingMasterTransfer"),
        ),
    
        "meeting.master.refresh.config.form"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setFormForMeetingMasterTransfer"),
        ),
    
       
       "contract.service.config"=>array(
           "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setServiceContractFilterConfig"),
       ),
    
        "contracts.list.pager"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setFormsContractForPager"),             
        ),
    
        "contract.filter.config"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setContractFilterConfig"),             
        ),
    
        "meetings.list.pager"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setFormsMeetingForPager"),             
        ),
    
    
      "customers.meeting.document.build.pdf"=>array(
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","DocumentParametersBuildPdfForMeeting"),
        ),
    
    "app_domoprime.quotation.works.build"=>array(
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setDataForWorksQuotation"),
        ),
    
    "app_domoprime.billing.works.build"=>array(
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setDataForWorksBilling"),
        ),
    
    
      "contract.export.data.populate"=>array(
            "customer.meeting.forms"=>array('CustomerMeetingFormEvents','setDataExport2ForContract') 
      ),
    
        "customers.meeting.premeeting.document.build.pdf"=>array(
             "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setParametersPdfForMeeting"),
        ),
    
     'application.hook.update'=>array(
           "customer.meeting.forms"=>array('CustomerMeetingFormEvents','setDataForContractHook'),                  
    ),
    
    'contract.api2.data'=>array(
           "customer.meeting.forms"=>array('CustomerMeetingFormEvents','setDataForContractApi2'),                  
    ),
    
    'meeting.api2.data'=>array(
           "customer.meeting.forms"=>array('CustomerMeetingFormEvents','setDataForMeetingApi2'),                  
    ),
);
