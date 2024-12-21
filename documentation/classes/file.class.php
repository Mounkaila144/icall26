<?php

class File {

    function __construct($file,$options=null);
    function getTime();
    function getDate();
    function getSize();
    function getFilename();
    function getName($extension="");
    function getMime();
    function getExtension();
    function get($name);
    function getDirectory();
    function isExist();    
    function delete();    
    function getContent($default="");       
    function getFile();    
    function isDir();
    function open();
    function write($data);
    function read($length);
    function close();
    function putContent($data="");
    function readfile();
    function rename($new_name);
    function copy($path,$name="");
    
}

