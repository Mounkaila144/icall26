<?php

class mfObjectCore { 

	function get($name,$default=null);
	function set($name,$value);
	function has($name);
	function add($data);
	public  function __call($method,$args);
	function getClass();
}
