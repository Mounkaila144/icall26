<?php

class mfValidatorDate { 

	protected function configure($options = array(), $messages = array());
	protected function doIsValid($value);
	protected function convertDateArrayToString($value);
	protected function isValueSet($values, $key);
	protected function isEmpty($value);
}
