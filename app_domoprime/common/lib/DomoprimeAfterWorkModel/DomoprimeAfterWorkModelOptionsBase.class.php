<?php


class DomoprimeAfterWorkModelOptionsBase {
    
    protected $options=array();
    
    function __construct($data) {
        $this->options= unserialize($data);       
    }
    
    function getPolluter()
    {
       return $this->polluter=$this->polluter===null?new DocumentSignaturePdf2Collection($this->options['polluter_logo']):$this->polluter;
    }
    
    function getLayer()
    {
         return $this->layer=$this->layer===null?new DocumentSignaturePdf2Collection($this->options['layer_logo']):$this->layer;
    }
    
    function getCompany()
    {
         return $this->company=$this->company===null?new DocumentSignaturePdf2Collection($this->options['company_logo']):$this->company;
    }
    
    function getFooterCompany()
    {
         return $this->company_footer=$this->company_footer===null?new DocumentSignaturePdf2Collection($this->options['company_footer']):$this->company_footer;
    }
    
     function getHeaderCompany()
    {
         return $this->company_header=$this->company_header===null?new DocumentSignaturePdf2Collection($this->options['company_header']):$this->company_header;
    }
        
    function getPartner()
    {
         return $this->partner=$this->partner===null?new DocumentSignaturePdf2Collection($this->options['partner_logo']):$this->partner;
    }    
    
    function isEmpty()
    {
        return !$this->options['company_logo'] && !$this->options['polluter_logo'] && !$this->options['layer_logo'] && !$this->options['company_header'] && !$this->options['company_footer'];
    }
    
    
}
