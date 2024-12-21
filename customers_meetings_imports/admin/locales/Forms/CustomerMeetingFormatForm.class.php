<?php


class CustomerMeetingFieldFormatImport extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'value'=>new mfValidatorString(array('required'=>false)),
            'name'=>new mfValidatorString(),
        ));
    }
}

class CustomerMeetingFormatForm extends mfForm {

    protected $user=null;
    
    function __construct($user,$defaults = array()) {
        $this->user=$user;
        parent::__construct($defaults);
    }
    
    function getUser()
    {
        return $this->user;
    }

    function configure() { 
        $this->form=new CustomerMeetingImportForm($this->getUser());        
        $this->setValidators(array(
            'name'=>new mfValidatorString()
        ));
        $this->embedFormForEach('fields', new CustomerMeetingFieldFormatImport(),count($this->getDefault('fields')));
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'check'))));
    }     
    
    function getHeader()
    {
        $values=array();
        foreach ($this['fields']->getValue() as $field)
        {
            $values[]=$field['name'];
        }    
        return $values;     
    }
    
    function formatHeaderForShow($header)
    {
        $name = explode("|", $header);
        return $name[0];     
    }
    
    
    function getForm()
    {
        return $this->form;
    }
    
    function getFieldsValues()
    {
        if ($this->fields_values===null)
        {    
            $this->fields_values=array();
            foreach ($this['fields']->getValue() as $index=>$field)
            {
                $this->fields_values[$field['name']."|".$index]=$field['value'];
            }
        }
        return $this->fields_values;
    }
    
    function getFieldsValuesForShow()
    {
        if ($this->fields_values_for_show===null)
        {    
            $this->fields_values_for_show=array();
            foreach ($this['fields']->getValue() as $field)
            {
                $this->fields_values_for_show[$field['name']]=$field['value'];
            }
        }
        return $this->fields_values_for_show;
    }
    
    function hasValueForm($field)
    {
        return in_array($field,$this->fields_values);
    }
    
   /* function getColumnValues()
    {
        $this->getFieldsValues();
        return array_values($this->fields_values);
    }*/
    
    function getFieldValue($field)
    {
        $this->getFieldsValues();
        return $this->fields_values[$field];
    }
    
    function getFieldValueForShow($field)
    {
        $this->getFieldsValuesForShow();
        return $this->fields_values_for_show[$field];
    }
    
   /* function hasFieldValue($field)
    {
        return 
    }*/
    
    function getFieldsFromForm()
    {
        return $this->form->getFieldsI18n();   
    }
    
    function getFieldsValuesFromValues($values)
    {
        $data=array();
        foreach ($values['fields'] as $index=>$field)
        {
            $data[$field['name'].$index]=$field['value'];
        } 
        return $data;
    }
    
    function check($validator,$values)
    {
        if ($this->getErrorSchema()->hasErrors())
            return $values;                   
        $fields_values=$this->getFieldsValuesFromValues($values);
        // Check doublons
        $double_errors=new mfValidatorErrorSchema($validator);
        foreach (array_count_values($fields_values) as $field=>$count)
        {
            if ($count!=1 && $field)
            {                            
                $double_errors->addError(new mfValidatorError($this->form->$field,__('The field {field} is affected {time} times',array('time'=>$count,'field' =>__('field-'.$field))))); 
            }    
        }    
        // check mandatory
        $missing_errors=new mfValidatorErrorSchema($validator);
        /* ========================= Debug =========================== */
//        echo "<pre>"; var_dump($fields_values); echo "</pre>";
        
        foreach ($this->form->getFields() as $field)
        {
            
            if ($this->form->$field->getOption('required'))
            {
//                echo "Field ".$field."<br/>";
                if (array_search($field,$fields_values)===false)
                {                                                    
                    $missing_errors->addError(new mfValidatorError($this->form->$field,__('The field {field} is not affected',array('field' =>__('field-'.$field)))));
                }    
            }    
        }      
        if (count($missing_errors))
            $this->errorSchema->addError($missing_errors,'missings');
        if (count($double_errors))
            $this->errorSchema->addError($double_errors,'doubles');
        return $values;
    }
    
    function isAffected($name)
    {
        $this->getFieldsValues();       
        return in_array($name,$this->fields_values);
    }
    
}