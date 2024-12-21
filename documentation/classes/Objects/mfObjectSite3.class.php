<?php


class mfObjectSite3 extends mfObject3 {
 
  
    static function getSelfClass();  
    static function getCollectionClass();       
    static function getActiveForSelect($fields,$site=null);
    static function getAllForSelect($fields,$site=null);
    static function getAll($site=null);
    static function isTableExist($site=null);
    static function getColumns($site=null);
    static function hasColumn($name,$site=null);
}

