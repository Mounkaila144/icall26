<?php

class mfCommandManager { 

	public function __construct(mfCommandSet $argumentSet = null, mfOptionSet $optionSet = null);
	public function setArgumentSet(mfCommandSet $argumentSet);
	public function getArgumentSet();
	public function setOptionSet(mfOptionSet $optionSet);
	public function getOptionSet();
	public function getArgumentValues();
	function process();
	protected function parseOption($argument);
	public function setOption(mfOption $option, $value);
	public function isValid();
	public function getOptionValues();
	public function getErrors();
}
