<?php

return array(
       
         
        "contract.hold"=>array(
             "customers_meetings"=>array("CustomerMeetingEvents","setContractHold"),
        ),
    
     "contract.unhold"=>array(
             "customers_meetings"=>array("CustomerMeetingEvents","setContractUnHold"),
        ),  
    
    
        "contracts.multiple.process"=>array(
             "customers_meetings"=>array("CustomerMeetingEvents","setContractMultipleProcess"),
        ),  
    
      'contract.change'=>array(
           "customers_meetings"=>array("CustomerMeetingEvents","setContractChange"),
           "customers_meetings.in_at_equal_opc"=>array("CustomerMeetingEvents","setMeetingForContractChange"),        
      ),
    
    
      'meeting.update'=>array(
           "customers_meetings.send_email_sale1"=>array("CustomerMeetingEvents","sendEmailToSale1"),
           "customers_meetings.in_at_equal_opc"=>array("CustomerMeetingEvents","setMeetingUpdate"),
           "customers_meetings_cache_management"=>array("CustomerMeetingEvents","setCacheForMeetingUpdate"),          
      ),          
    
     'meeting.before.save'=>array(
           "customers_meetings.in_at_equal_opc"=>array("CustomerMeetingEvents","setMeetingChangeBeforeSave"),
           "customers_meetings_cache_management"=>array("CustomerMeetingEvents","setCacheForMeetingUpdate"),    
      ),
    
      "contract.service.config"=>array(
           "customer.meeting"=>array("CustomerMeetingEvents","setServiceContractFilterConfig"),
      ),
    
      "contract.field.autosave"=>array(
           "customer.meeting"=>array("CustomerMeetingEvents","setAutoSaveContract"),
      ),
    
      "meeting.pre_execute"=>array(
                "contract"=>array("CustomerMeetingEvents","preExecuteMeeting"),   
        ),
    
     "meeting.copy"=>array(
                "contract"=>array("CustomerMeetingEvents","copyMeeting"),   
        ),
    
      "meeting.field.autosave.before.save"=>array(         
           "customers_meetings_cache_management"=>array("CustomerMeetingEvents","setCacheForMeetingUpdate"),          
      ),          
    
     'meetings.import'=>array(
           "customer.meeting"=>array("CustomerMeetingEvents","clearCache"),          
      ),
    
      'meeting.multiple.process'=>array(
           "meeting.multiple.process"=>array("CustomerMeetingEvents","clearCache"),          
      ),
);
