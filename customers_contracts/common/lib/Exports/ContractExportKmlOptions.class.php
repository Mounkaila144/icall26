<?php


class ContractExportKmlOptions {
   
    protected $options=array();
    
    function __construct($options) {
        $this->options=$options;
    }
    
    function getOption($name,$default=null)
    {
        return isset($this->options[$name])?$this->options[$name]:$default;
    }
    
    function setOption($name,$value)
    {
        $this->options[$name]=$value;
        return $this;
    }        
    
    function getOptions()
    {
        return $this->options;
    }
    
    function isOpcAtMode()
    {
        return $this->getOption('opc_at',false);
    }
    
    function isOpcRangeMode()
    {
        return $this->getOption('opc_range',false);
    }
    
    function isSavAtMode()
    {
        return $this->getOption('sav_at',false);
    }
    
    function isSavAtRangeMode()
    {
        return $this->getOption('sav_at_range',false);
    }
}
