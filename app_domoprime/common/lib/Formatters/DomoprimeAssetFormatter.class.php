<?php


class DomoprimeAssetFormatter extends mfFormatter {
    
    protected $settings=null;
    
    function __construct($value = null) {
        parent::__construct($value);
        $this->settings=DomoprimeSettings::load($value->getSite());
    }
    
    function getCreatedAt()
    {
        return new DateFormatter($this->getValue()->get('created_at'));
    }
    
    function getDatedAt()
    {
        return new DateFormatter($this->getValue()->get('dated_at'));
    }
    
   /* function getFormattedReference()
    {        
        $parameters=array('{id}'=>$this->getValue()->get('id'));
        return strtr($this->settings->get('quotation_reference_format'), $parameters);   
    }*/
}
