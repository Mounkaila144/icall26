<?php


class MarketingLeadsWpFormsFormatter extends mfFormatter {
    
    function getIncome()
    {
        return new FloatFormatter($this->getValue()->get('income'));
    } 
    
    function getCreatedAt()
    {
        return new DateFormatter($this->getValue()->get('created_at'));
    }
    
    function getOwner()
    {
        return __(ucfirst($this->getValue()->get('owner')));
    }
    
    function getEnergy()
    {
        return __(ucfirst($this->getValue()->get('energy')));
    }
}
