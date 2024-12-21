<?php

return array(
    
        "meeting.change"=>array(
                    "contract"=>array("CustomerContractEvents","meetingChange"),
                    "contract_opc"=>array("CustomerContractEvents","meetingChangeOpcAt"),
                    "contract_opened_at"=>array("CustomerContractEvents","meetingChangeOpenedAt"),
        ), 
    
    
        "meeting.remove"=>array(
                    "contract"=>array("CustomerContractEvents","meetingRemove"),                    
        ), 
    
        "meetings.remove"=>array(
                    "contract"=>array("CustomerContractEvents","meetingsRemove"),                    
        ), 
    
        "contract.change"=>array(
                    "contract.states.cache.management"=>array("CustomerContractEvents","setCacheForContractUpdate"),     
                    "contract"=>array("CustomerContractEvents","sendEmailToTeamManager"),
                    "contract.send_email_sale1"=>array("CustomerContractEvents","sendEmailToSale1"),
                    "contract.opened_at_equal_opc"=>array("CustomerContractEvents","setContractOpenedAtFromOpcAt"),
                    "contract.equal_opc_and_sav_opened_at"=>array("CustomerContractEvents","setContractOpcAtAndSavAtFromOpenedAt"),
                    "contract.dates_opened_at"=>array("CustomerContractEvents","setContractDatesOpenedAt"),
                    "contract.zone.max_contracts"=>array("CustomerContractEvents","checkMaxContractsByZone"),
                    "contract.dates.fill.from.opened_at"=>array("CustomerContractEvents","setContractDatesFromOpenedAt"),                     
                    "contract.billable.from.state"=>array("CustomerContractEvents","setContractBillableFromState"),                       
        ),  
    
        'contract.meeting.transfert' =>array(
            array("CustomerContractEvents","checkDateAndRangeOpcAt"),                   
        ),  
     
         "contract.load"=>array(                   
                    "contract.equal_opc_and_sav_opened_at"=>array("CustomerContractEvents","setNewContractOpcAtAndSavAtFromOpenedAt"),
                    "contract.dates.quoted.billing.from.opened_at"=>array("CustomerContractEvents","setNewContractQuotedAtAtAndBillingAtFromOpenedAt"),
                    "contract.zone.max_contracts"=>array("CustomerContractEvents","checkMaxContractsByZone"),
                    "contract.dates_opened_at"=>array("CustomerContractEvents","setContractDatesOpenedAt"),
        ),  
    
        "contract.copy"=>array(
                "contract"=>array("CustomerContractEvents","copyContract"),   
        ),
    
        "contract.pre_execute"=>array(
                "contract"=>array("CustomerContractEvents","preExecuteContract"),   
        ),
       
    'contracts.csv.export.validation'=>array(
                "contracts"=>array("CustomerContractEvents","setValidateExport"),   
        ),
    
     'contracts.csv.export.kml.validation'=>array(
                "contracts"=>array("CustomerContractEvents","setValidateKmlExport"),   
        ),
    
     "contract.field.autosave"=>array(
        "contracts"=>array("CustomerContractEvents","setAutoSaveFieldForContract"),                  
     ),
    
    "contract.field.autosave.before.save"=>array(
                    "contract.states.cache.management"=>array("CustomerContractEvents","setCacheForContractUpdate"),                            
    ),  
    
    "contract.change.attribution.before.save"=>array(
                    "contract.states.cache.management"=>array("CustomerContractEvents","setCacheForContractUpdate"),                            
    ),  
    
    
    "contract.filter2.config"=>array(            
              "contracts"=>array("CustomerContractEvents","setConfigFilter2ForContract"),   
      ),
    
 );