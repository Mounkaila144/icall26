<?php


class ContractExportKmlForm extends mfForm {
    
    function configure()
    {
      $this->setValidators(array(
           'opc_at'=> new mfValidatorBoolean(),
           'opc_range'=> new mfValidatorBoolean(),
           'sav_at'=> new mfValidatorBoolean(),
           'sav_at_range'=> new mfValidatorBoolean()
                ));
    }
    
    function getOptionsForFilter()
    {        
       return new ContractExportKmlOptions($this->getValues());      
    }
}

