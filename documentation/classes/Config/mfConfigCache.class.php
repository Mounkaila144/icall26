<?php

class mfConfigCache { 

	function __construct(mfApplicationConfiguration $configuration);
	function callHandler($handler, $configs, $cache,$parameters);
	function getHandlers();
	function executeHandler($handlerInstance,$configs);
	function checkConfig($configPath,$suffix="",$parameters=array());
	public function getPath();
	public function hasPath();
	public function setPath($path);
	public function getCacheName($name,$suffix="");
	function loadConfigHandlers();
	function isConfigHandlerLoaded();
	protected function loadConfigHandlersCore();
	protected function getHandler($name);
	protected function writeCacheFile($config, $cache, $data);
	public function import($config,$suffix="",$parameters=array());
	public function remove($name);
}
