<?php

class mfViewService { 

	static function getInstance($name);
	function __construct($name);
	function setOptions($options=array());
	protected function popAction();
	function render($moduleName,$actionName,$parameters=array());
	protected function execute($actionInstance);
	function handleAction($actionInstance);
	protected function executeAction($actionInstance);
	protected function handleView( $actionInstance, $viewName);
	protected function executeView($actionInstance,$viewName, $viewVariables);
}
