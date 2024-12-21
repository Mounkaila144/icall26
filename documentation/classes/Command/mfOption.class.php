<?php

class mfOption { 

	public function __construct($name, $shortcut = null, $mode = null, $help = '', $default = null);
	public function getShortcut();
	public function getName();
	public function acceptParameter();
	public function isParameterRequired();
	public function isParameterOptional();
	public function setDefault($default = null);
	public function getDefault();
	public function getHelp();
}
