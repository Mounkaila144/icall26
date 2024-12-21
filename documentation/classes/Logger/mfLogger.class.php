<?php

class mfLogger { 

	static public function getInstance();
	function __construct();
	function systemErrorHandler($errno, $errmsg, $filename, $linenum, $vars);
	static function addMessage($type,$message);
}
