<?php

class mfLayoutManager { 

	static function getInstance($template,$context,$moduleName=null,$options=array());
	function __construct($template,$context, $moduleName=null,$options=array());
	protected function setLayoutDirs($moduleName);
	function setLayout($file);
	function compile();
	function renderReference($params,$smarty_parent);
	protected function getContext();
}
