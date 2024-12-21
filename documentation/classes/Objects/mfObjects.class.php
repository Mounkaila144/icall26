<?php

class mfObjects { 

	function __construct($objects=array());
	public function offsetExists($name);
	public function offsetGet($name);
	public function offsetSet($offset, $value);
	public function offsetUnset($offset);
	public function __get($name);
	public function __set($name,$value);
	public function get($name);
	function __call($method, $arguments);
	public function has($name);
}
