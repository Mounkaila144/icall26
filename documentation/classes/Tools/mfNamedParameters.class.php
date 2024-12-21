<?php

class mfNamedParameters { 

	public function __construct($namespace = 'system/default');
	public function setDefaultNamespace($namespace, $move = true);
	public function getDefaultNamespace();
	public function clear();
	public function getNames($ns = null);
	public function getNamespaces();
	public function has($name, $ns = null);
	public function hasNamespace($ns);
	public function remove($name, $default = null, $ns = null);
	public function set($name, $value, $ns = null);
	public function setByRef($name, & $value, $ns = null);
	public function add($parameters, $ns = null);
	public function addByRef(& $parameters, $ns = null);
}
