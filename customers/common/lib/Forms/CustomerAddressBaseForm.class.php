<?php


class CustomerAddressBaseForm extends mfForm {
    
    function configure()
    {       
        $this->setValidators(array(
            'id'=> new mfValidatorInteger(),
            'address1'=>new mfValidatorString(),
            'address2'=>new mfValidatorString(array("required"=>false)),
            'postcode'=>new mfValidatorString(array('trim'=>true)),
            'city'=>new mfValidatorString(),
            'country'=>new mfValidatorI18nChoiceCountry(), 
            'state'=>new mfValidatorI18nState($this->getDefault('country')),
        ));       
    }
    
    function getMapping($fields=array())
    {
        if ($this->mapping===null)
        {
            $this->mapping=new mfArray();
            if (!$fields)            
                $fields = $this->getFields();            
            foreach ($fields as $field)
            {
               if (method_exists($this->$field, 'getMapping'))
                 $this->mapping[$field]=array('options'=>$this->$field->getMapping(),'name'=>$field,'validator'=>str_replace('mfValidator','',get_class($this->$field)));
               else
                 $this->mapping[$field]=array('options'=>$this->$field->getOptions(),'name'=>$field,'validator'=>str_replace('mfValidator','',get_class($this->$field)));
            }          
        }
        return $this->mapping;
    } 
}

