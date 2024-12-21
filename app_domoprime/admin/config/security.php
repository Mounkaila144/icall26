<?php

return array('default'=>array(
                            'is_secure'=>true,                               
                          ),
    
    "ExportBillingPdf"=>array(
        
            'credentials'=>array(array('superadmin','admin','app_domoprime_billing_list',
                                       'app_domoprime_contract_view_billing',
                                       'app_domoprime_meeting_view_billing',
                                       'iso_billing_owner'
                                       )),
    ),
    
    "ExportQuotationPdf"=>array(
        
            'credentials'=>array(array('superadmin','admin','app_domoprime_quotation_list',
                                       'app_domoprime_contract_view_quotation',
                                       'app_domoprime_meeting_view_quotation' ,
                                       'iso_quotation_owner'
                                       )),
    ),
); 
