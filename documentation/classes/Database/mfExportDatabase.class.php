<?php

class exportDatabase { 

	public static function getInstance();
	function SQLWrite($content);
	function SQLOpen();
	function SQLCLose();
	function getTables(&$list_tables,$site_forced="");
	function ExportKeys($table,$site_forced="");
	function ExportFields($table,$site_forced="");
	function ExportData($table,$site_forced="");
	function SQLExtractSite($host);
	function SQLExtractSites($sites);
	function SQLExportSitestoSQL($site);
}
