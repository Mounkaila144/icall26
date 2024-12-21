<?php

class mfCommandApplication { 

	function __construct();
	abstract public function configure();
	function registerTasks();
	function registerTask(mfTask $task);
	public function getTaskToExecute($name);
	public function getTask($name);
}
