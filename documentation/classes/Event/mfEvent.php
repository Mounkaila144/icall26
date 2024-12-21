<?php

class mfEvent { 

	public function __construct($subject, $name, $parameters = array());
	public function getSubject();
	public function getName();
	public function setReturnValue($value);
	public function getReturnValue();
	public function hasReturnValue();
	public function setProcessed($processed);
	public function isProcessed();
	public function getParameters();
	public function offsetExists($name);
	public function offsetGet($name);
	public function offsetSet($name, $value);
	public function offsetUnset($name);
}
