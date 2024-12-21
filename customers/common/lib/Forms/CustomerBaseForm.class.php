<?php


class CustomerBaseForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'id'=> new mfValidatorInteger(),
            'gender'=>new mfValidatorChoice(array("choices"=>array("Mrs"=>"Mrs","Mr"=>"Mr","Ms"=>"Ms"),"key"=>true,"required"=>false)),
            'firstname' => new mfValidatorString(array('trim'=>true)), 
            'lastname' => new mfValidatorString(array('trim'=>true)), 
            'email' => new mfValidatorEmail(array('required'=>false)),                                    
            'salary'=> new mfValidatorString(array('required'=>false)),
            'occupation'=> new mfValidatorString(array('required'=>false)),
            'age'=>new mfValidatorString(array('required'=>false)),
            'phone'=>new mfValidatorIntegerString(array('min_length'=>10,'max_length'=>10)),
            'mobile'=>new mfValidatorIntegerString(array('min_length'=>10,'max_length'=>10,'required'=>false)),     
            'mobile2'=>new mfValidatorIntegerString(array('min_length'=>10,'max_length'=>10,'required'=>false)),            
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

