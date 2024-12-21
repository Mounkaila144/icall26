<?php

class mfRequest { 

	public function __construct($parameters = array(), $attributes = array(), $options = array());
	public function initialize($parameters = array(), $attributes = array(), $options = array());
	public function getOptions();
	public function offsetExists($name);
	public function offsetGet($name);
	public function offsetSet($offset, $value);
	public function offsetUnset($offset);
	public function getParameters();
	public function getAttributes();
	public function getAttribute($name, $default = null);
	public function hasAttribute($name);
	public function setAttribute($name, $value);
	public function getParameter($name, $default = null);
	public function hasParameter($name);
	public function setParameter($name, $value);
	public function setMethod($method);
	public function getMethod();
	public function isMethod($method);
	public function setSite($site);
	public function getSite();
}
