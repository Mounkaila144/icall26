<?php

class mfConfigHandler { 

	abstract function execute($configFiles);
	public function __construct($parameters = null);
	public function initialize($parameters = null);
	public function getParameters();
	function move(&$items,$item,$position);
	function organize(&$source);
}
