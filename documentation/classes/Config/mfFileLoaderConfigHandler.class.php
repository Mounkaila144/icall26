<?php

class mfFileLoaderConfigHandler { 

	static public function parseConfigFiles($configFiles);
	static public function parseConfigFile($configFile);
	static public function replaceConstants($value);
	static public function getConfigurationWithEnvironment($config);
}
