<?php

class mfTask { 

	function __construct();
	protected function configure();
	abstract protected function execute($arguments = array(), $options = array());
	public function getCommandName();
	public function getSubCommandName();
	public function runFromCLI(mfCommandManager $commandManager);
	public function getArguments();
	public function addArguments($arguments);
	public function getOptions();
	public function addOptions($options);
	public function addOption($name, $shortcut = null, $mode = null, $help = '', $default = null);
}
