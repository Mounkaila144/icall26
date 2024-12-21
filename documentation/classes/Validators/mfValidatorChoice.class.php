<?php

class mfValidatorChoice { 

	protected function configure($options = array(), $messages = array());
	protected function doIsValid($value);
	public function getChoices();
	protected function cleanMultiple($value, $choices);
	protected function inChoices($value, array $choices = array());
	function getOptionsCount($option);
}
