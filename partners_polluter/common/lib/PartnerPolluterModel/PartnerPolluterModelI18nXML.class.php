<?php


class PartnerPolluterModelI18nXML extends XMLObject {
    
    
    
    function __construct(PartnerPolluterModelI18n $model_i18n, $options = array()) {
        parent::__construct($model_i18n, $options);
        $this->setOption('path', mfConfig::get('mf_site_app_cache_dir')."/exports/polluters/models/".$model_i18n->get('id'));
        $this->setOption('name','module');
    }
   
    
    function getName()
    {
        return $this->getItem()->getEscapedValue().".xml";
    }
    
     function toXML()
    {
        $this->output='<'.$this->getOption('name').'>';       
        foreach (array('signature','initiator_signature','value') as $field)
        {                                                      
            $this->output.=sprintf("<%s>%s</%s>",$field,$this->getItem()->get($field),$field);                       
        } 
        $this->output.='</'.$this->getOption('name').'>';      
        return $this;
    }
}
