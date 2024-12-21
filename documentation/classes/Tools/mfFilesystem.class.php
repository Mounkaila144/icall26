<?php

class mfFileSystem { 

	static function mkdir_multiple($list_dir);
	static function mkdirs($path);
	static function net_rmdir($dir);
	static function net_rmdirs($dirs);
	static function xcopy($src,$dst);
	static function getFileExtension($file);
	static function lock($name);
	static function hasLock($name);
	static function unLock($name);
	static protected function getLockFile($name);
	static function hasLockFile($name, $maxLockFileLifeTime = 0);
	static function glob_recursive($pattern,$flags=0);
	static function scandir($dir,$excluded=array());
	static function rename($old,$new);
	static function delete_files($files);
	static function delete($file);
	function foldersize($path);
}
