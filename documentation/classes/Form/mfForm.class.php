<?php

class mfForm { 

	function __construct($defaults = array(),$options=array());
	function configure();
	public function setValidators(array $validators);
	public function addValidators(array $validators);
	public function setValidatorSchema(mfValidatorSchema $validatorSchema);
	public function getValidator($name);
	public function hasValidator($name);
	public function setValidator($name, mfValidatorBase $validator);
	protected function setOption($name,$value);
	public function bind(array $noCheckedValues = null, array $noCheckedFiles = null);
	protected function doBind(array $values);
	public function getValues();
	public function getValue($field,$default=null);
	public function hasValue($field);
	public function hasValues();
	public function isValid();
	public function getErrorSchema();
	public function  setName($name);
	public function isReady();
	public function getName();
	public function offsetGet($name);
	public function resetFormFields();
	function getField($name);
	public function offsetSet($offset, $value);
	public function offsetUnset($offset);
	public function offsetExists($name);
	public function getFormFieldSchema();
	static function getToken($class,$secret=null);
	public function getCSRFToken($secret = null);
	public function addCSRFProtection($secret = null);
	static protected function deepArrayUnion($array1, $array2);
	function getValidatorSchema();
	function getOption($name,$default=null);
	function hasOption($name);
	function getOptions($default=array());
	public function embedForm($name, mfForm $form);
	public function embedFormForEach($name, mfForm $form, $n, $options = array(),$messages=array());
	public function createEmbedFormForEach($name, $class, $n, $options = array(),$messages=array());
	public function mergeForm(mfForm $form);
	public function setDefaults($defaults);
	public function setDefault($name, $default);
	public function addDefaults($defaults);
	public function getDefault($name,$default=null);
	public function hasDefault($name);
	public function getDefaults();
	public function hasDefaults();
	public function mergePostValidator(mfValidatorBase $validator = null);
	public function getEmbeddedForm($name);
	public function __get($name);
	public function getNotCheckedValue($name,$default=null);
	public function getNotCheckedValues();
	public function rename($name,$name_new);
	public function hasErrors();
	public function getFields();
	public function count();
}
