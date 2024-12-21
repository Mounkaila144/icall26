<?php


class PartnerViewForm extends PartnerBaseForm {
    
    
    
    function getValues()
    {
        $values = parent::getValues();        
         $parameters=array();
         foreach (['software_editor' ,'software_name' ,'software_date' ,'software_version','qualification_reference','qualification_date'] as $field)
              $parameters[$field]=$this[$field]->getValue();
         $values['parameters']=json_encode($parameters);         
        return $values;
    }
    
    
}


