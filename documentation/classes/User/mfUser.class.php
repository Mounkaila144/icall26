<?php

class mfUser { 

	public function __construct(mfStorage $storage, $options = array());
	public function initialize(mfStorage $storage, $options = array());
	public function getOptions();
	public function getOption($name,$default=null);
	public function offsetExists($name);
	public function offsetGet($name);
	public function offsetSet($offset, $value);
	public function offsetUnset($offset);
	public function getStorage();
	public function shutdown();
	public function getAttributes();
	public function getAttribute($name, $ns = null, $default = null);
	public function hasAttribute($name, $ns = null);
	public function setAttribute($name, $value, $ns = null);
	public function setCulture($culture);
	public function getCulture();
	public function getCountry();
	public function getLanguage();
	function getExtendedCulture($separator="_");
}
