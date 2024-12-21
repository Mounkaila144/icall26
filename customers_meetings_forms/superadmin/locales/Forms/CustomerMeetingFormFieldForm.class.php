<?php



 class CustomerMeetingFormFieldForm extends mfFormSite {
    
    protected static $widget_choices= array('select','checkbox'); //,'radio');
    
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
   
    function configure()
    {        
        if (!$this->hasDefaults())
            $this->addDefaults(array('type'=>'string','size'=>20));      
        $this->setValidators(array(
            'formfield_id'=>new mfValidatorInteger(array('required'=>false)),
            'request'=>new mfValidatorString(),
            'name'=>new mfValidatorNameForForm(),
            'required'=>new mfValidatorBoolean(),           
            'type'=>new mfValidatorChoice(array('choices'=>array('boolean','integer','string','text','choice'))),                
        ));
        if ($this->getDefault('type')=='integer')
        {
            $this->addValidators(array(
                    'min'=>new mfValidatorInteger(array('required'=>false)),
                    'max'=>new mfValidatorInteger(array('required'=>false)),
                    'size'=>new mfValidatorInteger(array('required'=>false)),
                    ));
        }
        elseif ($this->getDefault('type')=='string')
        {
             $this->addValidators(array(
                'size'=>new mfValidatorInteger(array('required'=>false)),
                'min_length'=>new mfValidatorInteger(array('required'=>false)),                 
                'max_length'=>new mfValidatorInteger(array('required'=>false))));
        }  
        elseif ($this->getDefault('type')=='text')
        {
             $this->addValidators(array(
                'cols'=>new mfValidatorInteger(array('required'=>false)),
                'rows'=>new mfValidatorInteger(array('required'=>false)),
                'min_length'=>new mfValidatorInteger(array('required'=>false)),
                'max_length'=>new mfValidatorInteger(array('required'=>false))));
        }  
        elseif ($this->getDefault('type')=='choice')
        {           
             $this->addValidators(array(
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
}


