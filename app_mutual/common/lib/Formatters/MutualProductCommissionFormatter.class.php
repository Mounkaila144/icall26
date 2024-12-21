<?php

class MutualProductCommissionFormatter extends mfFormatter {
    
    function getRatePercent()
    {
        return new FloatFormatter($this->getValue()->get('rate'));
    }
    
    function getStartedAt()
    {
        return DateFormatter($this->getValue()->get('started_at'));
    }
    
    function getEndedAt()
    {
        return DateFormatter($this->getValue()->get('ended_at'));
    }
    
}
