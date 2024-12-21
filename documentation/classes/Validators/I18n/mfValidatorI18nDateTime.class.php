<?php

class mfValidatorI18nDateTime { 

	protected function configure($options = array(), $messages = array());
	protected function doIsValid($value);
	function checkIsInRange($value);
	function checkIsMissing($value);
	protected function range($min,$max,$scale);
	protected function isEmpty($value);
}
