<?php

class MutualProductDecommissionFormatter extends mfFormatter {
    
    function getRatePercent()
    {
        return new FloatFormatter($this->getValue()->get('rate'));
    }
    
    function getStartedAt()
    {
        return new DateFormatter($this->getValue()->get('started_at'));
    }
    
    function getEndedAt()
    {
        return new DateFormatter($this->getValue()->get('ended_at'));
    }
    
    function getFixI18n()
    {
        return new FloatFormatter($this->getValue()->get('fix'));
    }
    
}
