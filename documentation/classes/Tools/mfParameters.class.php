<?php

class mfParameters { 

	function __construct($parameters=array());
	public function clear();
	public function getNames();
	public function has($name);
	public function remove($name, $default = null);
	public function set($name, $value);
	public function setByRef($name, & $value);
	public function add($parameters);
	public function addByRef(& $parameters);
	function isEqual($name,$value,$return_true=true,$return_false=false);
	public function serialize();
	public function unserialize($serialized);
}
