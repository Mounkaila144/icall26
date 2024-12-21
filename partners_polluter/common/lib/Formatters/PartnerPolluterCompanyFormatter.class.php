<?php

class PartnerPolluterCompanyFormatter extends mfFormatter {
    
    
    
    function getCumacMin()
    {
        return new FloatFormatter($this->getValue()->getCumacMin());
    }
    
    function getEndAt()
    {
        return new DateFormatter($this->getValue()->get('end_at'));
    }
}
