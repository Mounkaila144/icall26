<?php

return array(
      
    "marketing.leads.export"=>array(
        "marketing.leads.export.change.state"=>array("MarketingLeadsWpFormsEvents","changeLeadsExportState"),
    ),
    
    "marketing.leads.meeting.transfer.data"=>array(
        "app_domoprime_iso"=>array("MarketingLeadsWpFormsEvents","createFormForMeetingTransfer"),   
        "app_domoprime_iso_products"=>array("MarketingLeadsWpFormsEvents","createProductsForMeetingTransfer"),   
    ),
    
    "marketing.leads.meeting.multiple.transfer.data"=>array(
        "app_domoprime_iso"=>array("MarketingLeadsWpFormsEvents","createFormForMeetingTransferMultiple"),  
        "app_domoprime_iso_products"=>array("MarketingLeadsWpFormsEvents","createProductsForMeetingTransferMultiple"),   
    ),
    
    
);