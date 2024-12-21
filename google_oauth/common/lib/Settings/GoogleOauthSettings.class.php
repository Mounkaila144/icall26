<?php

class GoogleOauthSettings extends SiteSettings {
    
    /* function getFile() {
     //  $data='{"web":{"client_id":"1006732131340-rjon7skbo6fr4p97gc7fdsfrmvupotb7.apps.googleusercontent.com","project_id":"pelagic-height-124412","auth_uri":"https://accounts.google.com/o/oauth2/auth", "token_uri":"https://oauth2.googleapis.com/token",    "auth_provider_x509_cert_url":"https://www.googleapis.com/oauth2/v1/certs","client_secret":"GbRBZOmkdmT6xoqrkWnfcRVA"}}"';
       $data='{"web":{"client_id":"156257911619-g23ba9pfid60cgdv0n05805hd7bkhmv4.apps.googleusercontent.com","project_id":"affable-album-435723-u8","auth_uri":"https://accounts.google.com/o/oauth2/auth","token_uri":"https://oauth2.googleapis.com/token","auth_provider_x509_cert_url":"https://www.googleapis.com/oauth2/v1/certs","client_secret":"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","redirect_uris":["http://www.project61.net/admin/google/oauth/callback/user"]}}';
       return json_decode($data,true);    
    }  */
    
    function getConfigs()
    {
        return $this->configs=$this->configs===null?new mfArray(json_decode($this->get('google_oauth_configs'),true)):$this->configs;
    }
    
    function getCustomerUserUri()
    {
        return url_to("google_oauth_callback_customer",array(),'frontend','');
    }
    
     function getStoreUserUri()
    {
         return url_to("google_oauth_callback_store_user",array(),'frontend','');
    } 
    
     function getSupplierUserUri()
    {
         return url_to("google_oauth_callback_supplier_user",array(),'frontend','');
    } 
    
     function getUserUri()
    {
         return url_to("google_oauth_callback_user",array(),'admin','');
    }
    
    function getCarrierDeliveryUserUri()
    {
         return url_to("google_oauth_callback_carrier_delivery",array(),'frontend','');
    }
    
    function getConfigUrl()
    {
        return url_to("google_oauth",['action'=>'ExportConfigJson']);
    }
    
    
    
   
}
