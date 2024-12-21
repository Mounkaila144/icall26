<?php

class ObjectExistsValidator  { function __construct($class,$options,$site=null); }
class mfValidatorString extends mfValidatorBase { };
class mfValidatorBoolean extends mfValidatorBase { };
class mfValidatorChoice extends mfValidatorBase { };
class mfValidatorDomain extends mfValidatorBase { };
class mfvalidatorInteger extends mfValidatorBase { };
class mfvalidatorEmail extends mfValidatorBase { };
class mfValidatorProductURL extends mfValidatorBase { };


abstract class mfValidatorBase {
   
    public function __construct($options = array(), $messages = array());
    protected function configure($options = array(),$messages=array());
    public function setValidatorName($name);
    public function getValidatorName();
    public function getDefaultOptions();  
    function getOption($name,$default=null);
    function getOptionValue($name);
    public function addOption($name, $value = null) ;
    public function setOption($name, $value) ;
    public function hasOption($name);
    public function getOptions() ;
    public function setOptions($values);
    protected function getEmptyValue();
    function isValid($value);   
    public function addRequiredOption($name);
    public function getRequiredOptions();
    public function getDefaultMessages();
    static public function setGlobalDefaultMessage($name, $message);
    protected function setDefaultMessages($messages);
    public function setDefaultMessage($name, $message);
    public function getMessages() ;
    public function setMessages($values);
    public function setMessage($name, $value);
    public function getMessage($name);
    public function addMessage($name, $value);   
    public function addMessages($messages);
    static public function setCharset($charset);
    static public function getCharset();
    public function hasI18n();
    public function translateMessages($messages);
  
}
