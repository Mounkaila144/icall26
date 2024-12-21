<?php


abstract class mfEmailEngineCore {
    
    protected $mailer=null,$options=array(),$site=null;
        
    function __construct($options=array(),$site=null) {     
       $this->site=$site;
       $this->mailer=mfContext::getInstance()->getMailer();           
       $this->options=$options;
       $this->configure();
    }
    
    function configure()
    {
        $this->company=SiteCompanyUtils::getSiteCompany($this->getSite());   
    }
    
    function getSite()
    {
        return $this->site;
    }
     
    
    function getCompany()
    {
        return $this->company;
    }
    
    function getMailer()
    {
        return $this->mailer;
    }
    
     
     
}

