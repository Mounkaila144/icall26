<?php

class mfAutoloadConfigHandler { 

	public function execute($configFiles);
	static function glob_recursive($pattern,$flags=0);
	protected function parse(array $configFiles);
	function glob_recursive_compiled($pattern,$flags=0);
	static public function getConfiguration(array $configFiles);
	static protected function parseFile($file);
}
