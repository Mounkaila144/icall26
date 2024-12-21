<?php

class mfReport { 

	function getInstance($name,$directory="");
	function __construct($name,$directory=null);
	function getFilename();
	protected function open();
	function close();
	function addMessage($message);
}
