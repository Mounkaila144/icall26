<?php

return array(
  
       "contract.slave.forms"=>array(
           "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setMigrateFormsForContract')  ,
           "app_domoprime_iso_2"=>array('AppDomoprimeIsoEvents','setRequestForContract') ,          
       ),
    
        "contract.slave.new.form.config"=>array(
               "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setFormConfigForTransferContract"),
             //  "app_domoprime_iso_off"=>array("AppDomoprimeIsoEvents","setFormConfigForTransferMeetingOffline"),
        ),
    
        "contract.slave.new.form"=>array(
               "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setFormForTransferContract"),
               "app_domoprime_iso_off"=>array("AppDomoprimeIsoEvents","setFormForTransferContractOffline"),
        ),
    
    
    
      "meeting.slave.forms"=>array(
           "app_domoprime_iso"=>array('AppDomoprimeIsoEvents','setMigrateFormsForMeeting')  ,
           "app_domoprime_iso_2"=>array('AppDomoprimeIsoEvents','setRequestForMeeting') ,          
       ),            
    
       "meeting.slave.new.form.config"=>array(
               "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setFormConfigForTransferMeeting"),
             //  "app_domoprime_iso_off"=>array("AppDomoprimeIsoEvents","setFormConfigForTransferMeetingOffline"),
        ),
    
        "meeting.slave.new.form"=>array(
               "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setFormForTransferMeeting"),
               "app_domoprime_iso_off"=>array("AppDomoprimeIsoEvents","setFormForTransferMeetingOffline"),
        ),
       
     "contract.slave.refresh"=>array(
             "app_domoprime_iso"=>array("AppDomoprimeIsoEvents","setDataForSlaveTransferContrat"),
     )
);