<?php

class mfValidatorI18nState { 

	function __construct($country='en',$options = array(), $messages = array());
	function configure($options = array(), $messages = array());
	protected function doIsValid($value);
	protected function inChoices($value, array $choices = array());
}
