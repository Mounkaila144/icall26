<?php

class mfI18nRoutings { 

	function getInstance($culture);
	function __construct($culture=null);
	function getRoute($name,$parameters=array());
	function getAction($name,$parameters=array());
}
