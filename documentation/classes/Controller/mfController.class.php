<?php

class mfController { 

	public function __construct($context);
	public function initialize($context);
	function addParameter($key,$value);
	function getParameter($key);
	public function getRenderMode();
	public function setRenderMode($mode);
	public function getActionStack();
	public function getViewManager();
	function getControllerDirs($moduleName);
	protected function setViewManager($viewManager);
}
