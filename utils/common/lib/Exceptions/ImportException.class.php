<?php


class ImportException extends mfException {
    
    const ERROR_IMPORT_FILE_INVALID=1,
          ERROR_IMPORT_FIELD_NAME_INVALID=2,
          ERROR_IMPORT_FIELD_NAME_MANDATORY_MISSING=3,
          ERROR_IMPORT_FIELD_NAME_IDENTICAL=4,
          ERROR_IMPORT_FIELDS_ERROR=5,
          ERROR_IMPORT=6
            ;
    
    protected $parameters=null;
             
    function __construct($code,$parameters=array()) {
        $this->parameters=$parameters;   
        parent::__construct("Import [".$code."]", $code);
    }
    
    function get($name,$default=null)
    {
        return isset($this->parameters[$name])?$this->parameters[$name]:$default;
    } 
    
    function getI18nMessage()
    {
            switch ($this->getCode())
            {
                case self::ERROR_IMPORT_FILE_INVALID:return __("file is invalid.");                                                                    
                case self::ERROR_IMPORT_FIELD_NAME_INVALID:return __("Field name [%s] is invalid.",$this->get('name'));    
                case self::ERROR_IMPORT_FIELD_NAME_MANDATORY_MISSING:return __("Field name [%s] is mandatory.",$this->get('name'));    
                case self::ERROR_IMPORT_FIELD_NAME_IDENTICAL:return __("more one [%s] name exists in header.",$this->get('fields'));   
                case self::ERROR_IMPORT_FIELDS_ERROR:return __("line %s:",$this->get('line'))." ".implode("<br/>",$this->get('errors'));   
                case self::ERROR_IMPORT: return $this->parameters;
            }
    } 
    
}
