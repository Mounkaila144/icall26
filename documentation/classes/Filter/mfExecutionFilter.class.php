<?php

class mfExecutionFilter { 

	public function execute($filterChain);
	function handleAction($filterChain,$actionInstance);
	function executeAction($actionInstance);
	function handleView($filterChain, $actionInstance, $viewName);
	function executeView($moduleName, $actionName,$actionInstance, $viewName, $viewVariables);
	function getViewManager();
	function getCacheManager();
}
