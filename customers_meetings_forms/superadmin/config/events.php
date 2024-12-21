<?php

return array(
        "meeting.form"=>array(
                    "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setForm"),
                             ),
    
     "meeting.new.form"=>array(
                    "customer.meeting.forms"=>array("CustomerMeetingFormEvents","setForm"),
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
    
        "customers.meetings.document.build"=>array(
               "customer.meeting.forms"=>array("CustomerMeetingFormEvents","DocumentParametersBuild"),
        ),
    
         "customers.contracts.email.build"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","EmailParametersBuildForContract"),
        ),
    
        "customers.contracts.sms.build"=>array(
               "customer.contract.forms"=>array("CustomerMeetingFormEvents","SmsParametersBuildForContract"),
        ),
    
         "meetings.import.from.site"=>array(
                    "meetings.import.from.site.forms"=>array("CustomerMeetingFormEvents","importMeetings"),
                             ), 
    
          "site.initialization.form.config"=>array(
                "customers.meetings.forms.initialization.form.config"=>array("CustomerMeetingFormEvents","initializationFormConfig"),
        ),
    
         "site.initialization.execute"=>array(
                "customers.meetings.forms.initialization.execute"=>array("CustomerMeetingFormEvents","initializationExecute"),
        )
    );