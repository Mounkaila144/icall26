<?php

class ZipExtended { 

	function __construct($file,$options);
	function setOptions($options);
	function open();
	protected function configure();
	protected function _addDirectory($dir, $base="");
	public function addDirectory($dir,$base="");
	public function output();
}
