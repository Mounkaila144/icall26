<?php

class mfViewConfigHandler { 

	function execute($configFiles);
	public function getConfiguration(array $configFiles,$viewName);
	function configViewComponent($moduleName,$actionComponentInstance,$prefix);
	function configViewModule($moduleName,$actionName,$prefix);
	function configViewServiceModule($moduleName,$actionName,$prefix);
	function addJavascripts();
	function addComponentJavascripts();
	function addComponentStyleSheets();
	function addStyleSheets();
	function addLinks();
	function addClass();
	function addPlugins($name,$options,$defaults=array(),$viewManager='$this->viewManager');
	function addPluginsService($name,$defaults=array());
	function addLayout($moduleName);
	function addTemplate($moduleName, $actionName);
	function addTitle();
	function addMetas();
	function addMetasHttp();
	function addSettings($prefix);
	function addSecurity();
	function addPhpFunctionsComponentSecurity();
	function addComponentSecurity();
	function addComponentTemplate($moduleName, mfActionComponent $blockActionInstance);
	function addClassService();
	function addTemplateService($moduleName, $actionName);
	function addPhpFunctionsSecurity();
	function addPhpModifiersSecurity();
	function addPhpStaticClassesSecurity();
	function addPhpHandlingSecurity();
	function addSecurityService();
}
