<?php

class ObjectExistsValidator { 

	function __construct($class,$options,$site=null);
	protected function getSite();
	protected function configure($options,$messages);
	protected function doIsValid($value);
}
