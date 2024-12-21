<?php

class mfValidatorError { 

	public function __construct(mfValidatorBase $validator, $code, $arguments = array());
	public function __toString();
	public function getValue();
	public function getValidator();
	public function getMessageFormat();
	public function getArguments($raw = false);
}
