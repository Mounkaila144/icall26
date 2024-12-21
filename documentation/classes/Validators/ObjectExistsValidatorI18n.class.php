<?php

class ObjectExistsValidatorI18n { 

	function __construct($class,$language,$options,$site=null);
	protected function getLanguage();
	protected function configure($options,$messages);
	protected function doIsValid($value);
}
