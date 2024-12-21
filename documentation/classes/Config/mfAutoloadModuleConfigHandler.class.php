<?php

class mfAutoloadModuleConfigHandler { 

	protected function getModule();
	public function execute($configFiles);
	function glob_recursive($pattern,$flags=0);
	protected function parse(array $configFiles);
	protected function parseFile($file);
}
