<?php

class mfActionStackEntry { 

	public function __construct($moduleName, $actionName,$actionInstance);
	public function getActionName();
	public function getModuleName();
	public function getActionInstance();
}
