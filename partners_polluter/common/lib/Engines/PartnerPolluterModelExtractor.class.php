<?php

class PartnerPolluterModelExtractor {
    
    
    function __construct(PartnerPolluterModelI18n $model_i18n) {
        $this->model_i18=$model_i18n;
    }
    
    function getModelI18n()
    {
        return $this->model_i18;
    }
    
    function getExtractor()
    {
        return $this->extractor=$this->extractor===null?new MicrosoftDocxExtractor2(new File($this->getModelI18n()->getFile()->getFile())): $this->extractor;        
    }
    
    function process()
    {
        $this->getExtractor()->execute();
        
        $this->getExtractor()->getDocumentRelationsXML();
        
        $this->getModelI18n()->set('variables',(string)$this->getExtractor()->getCustomXML()->implode("|").
                                                "|============ IMAGES =================|".
                                               (string)$this->getExtractor()->getDocumentRelationsXML()->implode("|"));
        return $this;
    }
    
    
    
    
}

