<?php

class mfResponse { 

	function __construct($options=array());
	function initialize($options=array());
	function addJavascript($file,$options=array());
	function setJavascript($files=array());
	function addComponentJavascript($file,$component=null,$options=array());
	function setComponentJavascripts($files,$component=null);
	public function removeComponentJavascript($file,$component=null);
	public function getComponentJavascripts($componentName);
	public function removeJavascript($file);
	public function getJavascripts();
	public function setJavascriptLoaded($file);
	public function isJavascriptLoaded($file);
	public function getStyleSheets();
	function addStyleSheet($file,$options=array());
	function setStyleSheet($files=array());
	public function removeStylesheet($file);
	public function getComponentStyleSheets($componentName);
	function addComponentStyleSheet($file,$options=array());
	function setComponentStyleSheets($files=array(),$component=null);
	public function removeComponentStylesheet($file);
	public function setStylesheetLoaded($file);
	public function isStylesheetLoaded($file);
	function addVariable($name,$value);
	function getVariable($name);
	function addMeta($key, $value, $replace=true, $escape=true);
	public function getMetas();
	public function getLinks();
	function addLink($file,$options=array());
	public function removeLink($file);
	function setTitle($title,$escape=true);
	function getTitle();
	public function getCharset();
	protected function fixContentType($contentType);
}
