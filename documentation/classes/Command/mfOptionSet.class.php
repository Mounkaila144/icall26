<?php

class mfOptionSet { 

	public function __construct($options = array());
	public function setOptions($options = array());
	public function addOptions($options = array());
	public function addOption(mfOption $option);
	public function getOption($name);
	public function hasOption($name);
	public function getOptions();
	public function hasShortcut($name);
	public function getOptionForShortcut($shortcut);
	public function getDefaults();
	protected function shortcutToName($shortcut);
}
