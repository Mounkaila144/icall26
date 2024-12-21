<?php

class mfStorage { 

	public function __construct($options = array());
	public function initialize($options = array());
	function getOption($name,$default=null);
	public function getOptions();
	abstract public function read($key);
	abstract public function regenerate($destroy = false);
	abstract public function remove($key);
	abstract public function shutdown();
	abstract public function write($key, $data);
}
