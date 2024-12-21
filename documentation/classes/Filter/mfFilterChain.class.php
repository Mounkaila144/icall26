<?php

class mfFilterChain { 

	public function loadConfiguration($actionInstance);
	public function execute();
	public function hasFilter($class);
	public function register($filter);
}
