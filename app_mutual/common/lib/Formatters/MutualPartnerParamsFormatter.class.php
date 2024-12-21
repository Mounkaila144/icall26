<?php

class MutualPartnerParamsFormatter extends mfFormatter {
    
    function getTaxePercent()
    {
        return new FloatFormatter($this->getValue()->get('taxe'));
    }
    
    function getFeesI18n()
    {
        return new FloatFormatter($this->getValue()->get('fees'));
    }
    
    function getStartedAt()
    {
        return new DateFormatter($this->getValue()->get('started_at'));
    }
    
    function getEndedAt()
    {
        return new DateFormatter($this->getValue()->get('ended_at'));
    }
    
}
