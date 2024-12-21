<?php


class ObjectExistsValidatorI18n extends ObjectExistsValidator {

    protected $site=null,$language=null,$class="";

    function __construct($class,$language,$options,$site=null)
    {
        $this->site=$site;
        $this->language=$language;
        parent::__construct($class,$options);
    }
    
    protected function getLanguage()
    {
        return $this->language;
    }
    
    protected function configure($options,$messages)
    {
        parent::configure($options,$messages);
        $this->addMessage("invalid",__("invalid language [{lang}]"));
    }
    
    protected function doIsValid($value)
    {
        $class=$this->class;
        if (!class_exists($class))
            throw new mfValidatorError($this, 'invalid');
        $item=new $class($value,$this->getSite());
        if ($item->isNotLoaded())
        {
            if ($value=="" || $value=="0")
            {
                if ($this->getOption('required')==true)
                    throw new mfValidatorError($this, 'required');
                if ($this->getOption('key'))
                    return $item->getKey();
                return $item;
            }
            throw new mfValidatorError($this, 'notexist', array('value'=> $value));
        }
        if ($item->get('lang')!=$this->getLanguage())
            throw new mfValidatorError($this,'invalid',array('lang'=>$this->getLanguage()));
        if ($this->getOption('key'))
            return $item->getKey();
        return $item;
    }

}


	
	
	
