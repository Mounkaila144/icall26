<?php

class mfValidatorSchemaCompare { 

	public function __construct($leftField, $operator, $rightField, $options = array(), $messages = array());
	protected function doIsValid($values);
}
