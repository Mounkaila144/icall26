<?php

class MutualEngineCalculationMeetingFormatter extends mfFormatter {
    
    function getCommissionI18n()
    {
        return new FloatFormatter($this->getValue()->get('commission'));
    }
    
    function getDecommissionI18n()
    {
        return new FloatFormatter($this->getValue()->get('decommission'));
    }
    
}
