<?php

class mfFilter { 

	public function __construct($context, $parameters = array());
	public function initialize($context, $parameters = array());
	protected function isFirstCall();
	public function getParameters();
	public function getParameter($name, $default = null);
	public function hasParameter($name);
	public function setParameter($name, $value);
}
