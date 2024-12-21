<?php



 class CustomerMeetingFormFieldForm extends mfForm {
    
     protected static $widget_choices= array('select','checkbox'); //,'radio');
   
    function configure()
    {        
        if (!$this->hasDefaults())
            $this->addDefaults(array('type'=>'string','size'=>20));      
        $this->setValidators(array(
            'formfield_id'=>new mfValidatorInteger(array('required'=>false)),
            'request'=>new mfValidatorString(),
            'name'=>new mfValidatorNameForForm(),
            'required'=>new mfValidatorBoolean(),           
            'is_visible'=>new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')),  
            'is_exportable'=>new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')),            
            'type'=>new mfValidatorChoice(array('choices'=>array('boolean','integer','string','text','choice'))),                
        ));
        if ($this->getDefault('type')=='integer')
        {
            $this->addValidators(array(
                    'min'=>new mfValidatorInteger(array('required'=>false)),
                    'max'=>new mfValidatorInteger(array('required'=>false)),
                    'size'=>new mfValidatorInteger(array('required'=>false)),
                    'default'=>new mfValidatorInteger(array('required'=>false)),  
                    ));
        }
        elseif ($this->getDefault('type')=='string')
        {
             $this->addValidators(array(
                'default'=>new mfValidatorString(array('required'=>false)),  
                'size'=>new mfValidatorInteger(array('required'=>false)),
                'min_length'=>new mfValidatorInteger(array('required'=>false)),                 
                'max_length'=>new mfValidatorInteger(array('required'=>false))));
        }  
        elseif ($this->getDefault('type')=='text')
        {
             $this->addValidators(array(
                'default'=>new mfValidatorString(array('required'=>false)),  
                'cols'=>new mfValidatorInteger(array('required'=>false)),
                'rows'=>new mfValidatorInteger(array('required'=>false)),
                'min_length'=>new mfValidatorInteger(array('required'=>false)),
                'max_length'=>new mfValidatorInteger(array('required'=>false))));
        }  
        elseif ($this->getDefault('type')=='choice')
        {           
             $this->addValidators(array(
                'default'=>new mfValidatorString(array('required'=>false)),   // Default from select ?
                'widget'=>new mfValidatorChoice(array('choices'=>self::getWidgetForChoices())),
                'multiple'=>new mfValidatorBoolean(),
                'choices'=>new mfValidatorSchemaForEach(new mfValidatorString(array('required'=>false)),count($this->getDefault('choices')))));               
        }          
            
    }
    
    function getType()
    {
        return $this->type->getOption('choices');
    }
    
    static function getWidgetForChoices()
    {
        return self::$widget_choices;
    }
    
    static function getWidgetForChoicesDefault()
    {
        return 'select';
    }
}


