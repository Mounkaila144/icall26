<?php

class mfValidatorTime { 

	protected function configure($options = array(), $messages = array());
	protected function doIsValid($value);
	protected function convertTimeArrayToTimestamp($value);
	protected function isValueSet($values, $key);
	protected function isEmpty($value);
}
