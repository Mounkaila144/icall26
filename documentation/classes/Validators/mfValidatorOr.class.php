<?php

class mfValidatorOr { 

	public function __construct($validators = null, $options = array(), $messages = array());
	protected function configure($options = array(), $messages = array());
	public function addValidator(mfValidatorBase $validator);
	public function getValidators();
	protected function doIsValid($value);
}
