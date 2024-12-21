<?php

class mfValidatorSchema { 

	function __construct($fields=null, $options = array(), $messages = array());
	protected function setFields($fields=null);
	public function isValid($values);
	protected function doIsValid($values);
	public function postClean($values);
	function getValues();
	function getValue($name);
	public function offsetExists($name);
	public function offsetGet($name);
	public function offsetSet($name, $validator);
	public function offsetUnset($name);
	function getErrorSchema();
	public function rewind();
	public function key();
	public function current();
	public function next();
	public function valid();
	function getFields();
	function getFieldsKey();
	function hasValidator($name);
	function getSchema();
	public function getBytes($value);
	public function getPostValidator();
	public function setPostValidator(mfValidatorBase $validator);
	function getField($name);
	function addValidators($validators);
	function addValidator($name,$validator);
}
