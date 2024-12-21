<?php

class smartyView { 

	function __construct($context,$moduleName=null,$options=array());
	function debug();
	function render();
	function renderDisplay();
	function templateExists($template=null);
	function setTemplate($template);
	function getTemplate();
	function getLayoutManager($options=array());
	function registerWidget($widgetName,$parameters,$type='function');
	function getWidget($widgetName);
	function hasWidget($widgetName);
	function isRegisteredPlugin($type,$name);
	function loadModifiers($modifiers);
	function loadWidgets($widgets=array());
	function loadFunctions($functions=array());
	function loadBlocks($widgets=array());
}
