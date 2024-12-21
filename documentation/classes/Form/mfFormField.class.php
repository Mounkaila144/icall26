<?php

class mfFormField { 

	public function __construct(mfValidatorBase $validator, mfFormField $parent = null, $name="", $value="", mfValidatorError $error = null);
	public function getError($index=0);
	public function hasError();
	public function setError($error);
	public function getValidator();
	function getValue();
	public function __toString();
	public function getValueExist($value,$return_true=true,$return_false=false);
	public function getValueWithDefault($default="");
	public function getParent();
	public  function JSON();
	public function offsetUnset($offset);
	public function offsetSet($offset, $value);
	public function offsetGet($name);
	public function offsetExists($name);
}
