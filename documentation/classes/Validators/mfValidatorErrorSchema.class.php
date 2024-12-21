<?php

class mfValidatorErrorSchema { 

	function __construct(mfValidatorBase $validator, $errors = array());
	public function addErrors($errors);
	public function addError(mfValidatorError $error, $name = null);
	public function hasErrors();
	public function count();
	public function rewind();
	public function key();
	public function current();
	public function next();
	public function valid();
	public function offsetExists($name);
	public function offsetGet($name);
	public function offsetSet($offset, $value);
	public function offsetUnset($offset);
	public function getError($name);
	public function getErrors();
	public function getErrorsMessage();
	public function hasGlobalErrors();
	public function getGlobalErrors();
	public function getNamedErrors();
	public function getNamedErrorsMessage();
	public function getNamedErrorMessage($named_error);
}
