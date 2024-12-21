<?php

class mfValidatorChoiceImport extends mfValidatorChoice
{
    /**
        * Configures the current validator.
        *
        * Available options:
        *
        *  * choices:  An array of expected values (required)
        *  * multiple: true if the select tag must allow multiple selections
        *  * min:      The minimum number of values that need to be selected (this option is only active if multiple is true)
        *  * max:      The maximum number of values that need to be selected (this option is only active if multiple is true)
        *
        * @param array $options    An array of options
        * @param array $messages   An array of error messages
        *
        * @see sfValidatorBase
    */
    protected function configure($options = array(), $messages = array())
    {
        parent::configure($options, $messages);  
        $this->addOption('upper',false);     
        $this->addOption('noaccent',false); 
    }

    function noaccent($string) {
        return mfTools::I18N_noaccent(utf8_encode(html_entity_decode($string)));
    } 
    /**
     * @see sfValidatorBase
    */
    protected function doIsValid($value)
    {
        $choices = $this->getChoices();        
        if ($this->getOption('noaccent'))
            $value=$this->noaccent($value);             
        if ($this->getOption('upper'))
            $value= mb_strtoupper ($value);    
        if ($this->getOption('multiple'))
        {
            $value = $this->cleanMultiple($value, $choices);
        }
        else
        {
            if (!$this->inChoices($value, $choices))
            {
                throw new mfValidatorError($this, 'invalid', array('value' => $value));
            }
        }
        return $value;
    }

    public function getChoices()
    {
        $choices = $this->getOption('choices');
        $params=isset($choices['params'])?$choices['params']:array();
        unset($choices['params']);
        if (is_callable($choices))
            $choices = call_user_func_array($choices,$params); 
        return $choices;
    }

    /**
     * Cleans a value when multiple is true.
     *
     * @param  mixed $value The submitted value
     *
     * @return array The cleaned value
    */
    protected function cleanMultiple($value, $choices)
    {
        if (!is_array($value))
            $value = array($value);       
        foreach ($value as $v)
        {
            if (!$this->inChoices($v, $choices))
            {       
                throw new mfValidatorError($this, 'invalid', array('value' => $v));
            }  
        }
        $count = count($value);
        if ($this->hasOption('min') && $count < $this->getOption('min'))
            throw new mfValidatorError($this, 'min', array('count' => $count, 'min' => $this->getOption('min')));
        if ($this->hasOption('max') && $count > $this->getOption('max'))
            throw new mfValidatorError($this, 'max', array('count' => $count, 'max' => $this->getOption('max')));
        return $value;
    }

    protected function inChoices($value, array $choices = array())
    {
        $field=$this->getOption('key')?"name":"choice"; // key or value
        foreach ($choices as $name=>$choice)
        {
            if ((string) $$field == (string) $value)
                return true;
        }
        return false;
    }

    function getOptionsCount($option)
    {
        return count($this->getOption($option));
    }
}
