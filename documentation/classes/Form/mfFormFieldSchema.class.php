<?php

class mfFormFieldSchema { 

	public function __construct(mfValidatorSchema $validator, mfFormField $parent = null, $name, $value, mfValidatorError $error = null);
	public function offsetExists($name);
	public function offsetGet($name);
	public function offsetSet($offset, $value);
	public function offsetUnset($offset);
	public function rewind();
	public function key();
	public function current();
	public function next();
	public function valid();
	public function count();
	public function getErrors();
	public function getValues();
	public function JSON();
	public function hasValues();
	public function hasValue($name);
}
