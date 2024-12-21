<?php

class importDatabase { 

	public static function getInstance();
	function getInformations($name);
	function import($file,$site=null);
	function execute();
	function getErrors();
	function isError();
	function executeMultiple($queries,$site=null);
	protected function executeMultipleRequest($sql_to_play);
}
