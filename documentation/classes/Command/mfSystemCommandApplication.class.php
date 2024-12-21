<?php

class mfSystemCommandApplication { 

	function configure();
	function run();
	function loadTasks(mfSystemConfiguration $configuration);
	public function autoloadTask($class);
}
