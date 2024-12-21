<?php


class DomoprimeBillingPdf2Base extends wkhtmltopdf{
    
    
    public function __construct($options = array(), $application = null, $site = null) {
        parent::__construct($options, $application, $site);
    }
    
}
