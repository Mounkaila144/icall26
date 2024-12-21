<?php


class PartnerPolluterDocumentXML extends XMLObject {
    
    protected $document=null;
    
    function __construct(PartnerPolluterDocument $document, $options = array()) {
        $this->document=$document;                
        parent::__construct($document->getModel()->getI18n(), $options);
        $this->setOption('path', mfConfig::get('mf_site_app_cache_dir')."/exports/polluters/documents/".$document->get('id'));
        $this->setOption('name','module');
    }
   
    function getDocument()
    {
        return $this->document;
    }
    
    function getName()
    {
        return $this->getDocument()->getEscapedValue().".xml";
    }
    
     function toXML()
    {
        $this->output='<'.$this->getOption('name').'>';       
        foreach (array('signature','initiator','value') as $field)
        {                                                      
            $this->output.=sprintf("<%s>%s</%s>",$field,$this->getItem()->get($field),$field);                       
        } 
        $this->output.='</'.$this->getOption('name').'>';      
        return $this;
    }
}
