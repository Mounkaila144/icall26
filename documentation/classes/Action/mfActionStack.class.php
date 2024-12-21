<?php

class mfActionStack { 

	public function addEntry($moduleName, $actionName,$instanceName);
	public function getEntry($index);
	public function popEntry();
	public function getFirstEntry();
	public function getLastEntry();
	public function getSize();
	public function getPrevious();
	public function findAction($module,$action);
}
