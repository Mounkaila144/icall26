<?php

class mfUrl { 

	function __construct($url);
	function getDomain();
	function getPort();
	function getProtocol();
	function getPath();
	function getQuery();
	function getFragment();
	function getUrl();
	function __toString();
	function getDomainTLS();
}
