<?php

class mfCommand { 

	public function __construct($name, $mode = null, $help = '', $default = null);
	public function getName();
	public function isRequired();
	public function setDefault($default = null);
	public function getDefault();
	public function getHelp();
}
