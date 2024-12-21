<?php

class mfConfig { 

	static function getControllerDir($moduleName);
	static function get($key,$default=null);
	public static function add($parameters = array());
	public static function set($name, $value);
	public static function debug();
	public static function has($name);
	static function getSuperAdmin($name,$default=null);
}
