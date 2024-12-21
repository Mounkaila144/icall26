<?php

class MarketingLeadsWpFormsLeadsImportForm extends mfForm {

    protected $user=null;
    
    function __construct($user,$defaults = array()) {
        $this->user=$user;
        parent::__construct($defaults);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure() { 
        $this->setDefaults(array('has_header'=>'YES','mode'=>'Normal'));
        $settings=MarketingLeadsWpSettings::load();
        $this->setValidators(array(              
            'file'=>new mfValidatorFile(array('max_size'=>5 * 1024 *1024,'mime_types'=>array( 'text/plain','text/csv', 'text/comma-separated-values', /* 'application/zip' */))),                                
            'format_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>MarketingLeadsWpFormsLeadsImportFormatBase::getFormatForSelect())),
            'site_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=> MarketingLeadsWpLandingPageSite::getCampaignsAndSiteForSelect()->toArray())),
            'has_header'=>new mfValidatorBoolean(array('empty_value'=>'YES','true'=>'YES','false'=>'NO')),
            'mode'=>new mfValidatorChoice(array('key'=>true,'choices'=>array('normal'=>'Normal','debug'=>'Debug'))),//,'empty_value'=>'normal'
        ));
    }
    
    function hasFormats()
    {
        return (count($this->format_id->getOption('choices'))!=0);
    }
    
}
