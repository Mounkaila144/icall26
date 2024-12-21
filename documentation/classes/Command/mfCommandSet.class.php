<?php

class mfCommandSet { 

	public function __construct($arguments = array());
	public function setArguments($arguments = array());
	public function addArguments($arguments = array());
	public function addArgument(mfCommand $argument);
	public function getArgument($name);
	public function hasArgument($name);
	public function getArguments();
	public function getArgumentCount();
	public function getArgumentRequiredCount();
	public function getDefaults();
}
