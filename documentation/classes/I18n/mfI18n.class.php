<?php

class mfI18n { 

	function __construct($options=array());
	function loadMessages($file,$catalog);
	protected function loadCatalog($catalog);
	protected function escape($value="");
	function __($text,$parameters=array(),$catalog='messages',$module=null);
	protected function replaceParametersInText($text,$parameters);
	protected function  escapeText($str);
	public function getCulture();
	public function setCulture($culture);
	protected function loadDirectories();
	protected function loadSiteDirectorySources();
	protected function loadModuleDirectorySources();
	protected function loadApplicationDirectorySources();
	public function setMessageSourcesModule($moduleName="",$actionName="");
	public function clearMessageSourcesModule($moduleName="",$actionName="");
	public function setMessageSourcesComponent($moduleName,$blockName,$service="blocks");
	public function clearMessageSourcesComponent($module="",$block=null);
	public function addMessageI18nSources($dirs);
	function addExternalMessageSources($dir);
	function addModuleMessageSources($dir);
	function addModuleMessageSource($moduleName);
	public function listenToChangeActionEvent(mfEvent $event);
	function setMessages($texts,$catalog='messages');
}
