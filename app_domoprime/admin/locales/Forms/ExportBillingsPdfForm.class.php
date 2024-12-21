<?php


class ExportBillingsPdfForm extends mfForm {
    
    
    function configure()
    {
        $this->setValidators(array(
            'selection'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selection')))
        ));
    }
    
    function getBillings()
    {
        if ($this->billings==null)
        {
            $this->billings= DomoprimeBilling::getBillingsFromSelection(new mfArray($this['selection']->getValue()));
        }    
        return $this->billings;
    }
    
    function getSelection()
    {
        return new mfArray($this['selection']->getValue());
    }
}
