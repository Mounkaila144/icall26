<?php

class mfWebComponentController { 

	protected function setViewManager($viewManager);
	function getTemplateDirs($moduleName,$blockName,$template);
	protected function handleAction(mfActionComponent $actionInstance);
	function executeAction($actionInstance);
	function handleView($actionInstance, $viewName);
	function executeView($moduleName, $actionblockName, $viewName,$actionInstance, $viewVariables);
	protected function getModuleDirs($name);
	protected function moduleExists($name);
	function getComponentDirs($moduleName);
	protected function setComponentId($moduleName, $blockName,$parameters);
	protected function getComponent();
	protected function hasComponent();
	protected function setComponent($id,$instance);
	protected function getAction($moduleName, $blockName,$parameters);
	function actionExist($moduleName,$blockName);
	public function execute($actionInstance);
	function loadComponentAction($componentName,$parameters);
	function forward($componentName,$parameters);
	protected function popComponentStack($actionInstance);
}
