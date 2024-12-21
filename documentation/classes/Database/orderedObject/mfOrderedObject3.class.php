<?php

class mfOrderedObject3 extends mfObject3 {
            
    function configure();     
    function getNode(); 
    function moveTo($node);   
    function moveToLast();
    function moveToFirst();
    function moveToNext();
    function moveToPrevious();
    function getFirstSibling();
    function getNextSibling();
    function getLastSibling();
    function getPreviousSibling();
    function isLast();
    function isFirst();
    static function getLastPosition(); 
    static  function updatePositions(mfArray $positions);
     
}

