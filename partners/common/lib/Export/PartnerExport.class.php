<?php

class PartnerExport {
           
     static function getFieldsForExport()
    {        
         $values = new mfArray(array(
            'contract.partner.name'=>new CustomerContractFormatExportModel('Partner','name',array("string"=>"upper")), 
            'contract.partner.siret'=>new CustomerContractFormatExportModel('Partner','siret'), 
            'contract.partner.comments'=>new  CustomerContractFormatExportModel('Partner','comments'), 
         ));
         
        foreach (['software_editor' ,'software_name' ,'software_date' ,'software_version','qualification_reference','qualification_date'] as $field)
            $values->set('contract.partner.'.$field,new PartnerParameterFormatExportModel($field));
        return $values;
    }
    
    
}
