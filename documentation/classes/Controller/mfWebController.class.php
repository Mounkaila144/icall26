<?php

class mfWebController { 

	function actionExists($moduleName,$actionName);
	function forward($moduleName, $actionName);
	function getAction($moduleName, $actionName);
	public function redirect($url, $delay=0,$statusCode = 302);
}
