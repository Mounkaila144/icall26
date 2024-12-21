<?php

class widgetBase { 

	function __construct($context=null,$options=null);
	function getRequest();
	function render($parameters,$smarty);
	protected function configure();
	protected function getResponse();
	function getURL($file,$options,$ext='js');
	protected function setParameters($parameters);
	protected function getParameter($name,$default=null);
	protected function getContext();
}
