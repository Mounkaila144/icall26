<?php


class DomoprimeQuotationEngineException extends mfException {
     
    const ENGINE_ERROR_CALCULATION_INVALID=1;
    const ENGINE_ERROR_REQUEST_INVALID=2;
    
    function __construct($code) {
        parent::__construct("", $code);
    }
    
    
    function getI18n()
    {
        function getI18n()
    {
        switch ($this->getCode())
        {
            case self::ENGINE_ERROR_CALCULATION_INVALID: return __("Calculation is invalid.");
            case self::ENGINE_ERROR_REQUEST_INVALID: return __("Request is invalid.");
        }
    }
    }
}
