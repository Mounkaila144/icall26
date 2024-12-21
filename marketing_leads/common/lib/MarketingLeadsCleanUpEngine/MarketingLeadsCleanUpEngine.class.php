<?php

class MarketingLeadsCleanUpEngine  {
     
    protected $site = null;
    
    function __construct($site=null) {
        $this->site = $site;
    }
    
    function process()
    {
        $this->cleanUpPhone(); //OK
        $this->cleanUpPostCode(); //OK
        $this->cleanUpDoubles(); //OK
        $this->blacklistPhones(); //OK
    }
    
    function cleanUpPhone()
    {
        MarketingLeadsWpFormsUtils::cleanUpPhones($this->site);
    }
    
    function cleanUpDoubles()
    {
        MarketingLeadsWpFormsUtils::cleanDuplicates($this->site);
    }
    
    function cleanUpPostCode()
    {
        MarketingLeadsWpFormsUtils::cleanUpPostCodes($this->site);
    }
    
    function blacklistPhones()
    {
        MarketingLeadsWpFormsUtils::blacklistPhones($this->site);
    }
}
