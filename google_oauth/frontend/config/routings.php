<?php
return array(
    

   
    
     "google_oauth_callback_user"=>array("pattern"=>'/google/oauth/callback/user',
                            "module"=>"google_oauth",
                            "action"=>"callbackUser",
                            ),
    
     "google_oauth_callback_store_user"=>array("pattern"=>'/google/oauth/callback/store/user',
                            "module"=>"google_oauth",
                            "action"=>"callbackStoreUser",
                            ),
    
     "google_oauth_callback_supplier_user"=>array("pattern"=>'/google/oauth/callback/supplieruser',
                            "module"=>"google_oauth",
                            "action"=>"callbackSupplierUser",
                            ),
    
     "google_oauth_callback_customer"=>array("pattern"=>'/google/oauth/callback/customer',
                            "module"=>"google_oauth",
                            "action"=>"callbackCustomer",
                            ),
    
      "google_oauth_callback_carrier_delivery"=>array("pattern"=>'/google/oauth/callback/carrier/delivery',
                            "module"=>"google_oauth",
                            "action"=>"callbackCarrierDeliveryUser",
                            ),
);