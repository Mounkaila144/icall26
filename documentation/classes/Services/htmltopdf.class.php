<?php

class htmltopdf { 

	function __construct($options=array(),$application=null,$site=null);
	abstract protected function getFilename();
	public function configure();
	protected function setApplicationAndSite($application,$site);
	public function initialize();
	public function createPDF($moduleName,$actionName,$parameters=array());
	public function getContent();
	public function save($file="",$path="");
	protected function _header();
	protected function _output();
	public function output();
	public function _getFilename();
	public function setOption($name,$value);
	public function setOptions($options=array());
	public function _setFilename($filename);
	public function exist();
	public function debug($value=true);
	function getOption($name,$default="");
	protected function getApplication();
	function getSiteName();
	function getSite();
	function setParameters($parameters);
}
