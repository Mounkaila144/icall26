<?php


class MarketingLeadsWpFormsBySiteFormatter extends mfFormatter {

    function getCreatedAt()
    {
        if($this->getValue()->get('created_at') != null)
            return new DateFormatter($this->getValue()->get('created_at'));
    }
}
