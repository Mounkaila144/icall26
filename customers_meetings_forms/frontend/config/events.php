<?php

return array(
        
        "contract.slave.new.form.config"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","setFormConfigForContract"),
        ),
    
        "contract.slave.new.form"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","setFormForContract"),
        ),
    
       "meeting.slave.new.form.config"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","setFormConfigForMeeting"),
        ),
    
        "meeting.slave.new.form"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","setFormForMeeting"),
        ),
    
        "contract.slave.refresh"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","getDataForContractMasterTransfer"),
        ),
    
         "meeting.slave.refresh"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","getDataForMeetingMasterTransfer"),
        ),
    );
