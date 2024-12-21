<?php



abstract class orderedObject extends mfObject2 {
    
    
    abstract protected function executeLastPositionQuery($db);
    
    abstract protected function executeShiftUpQuery($db);
    
    abstract protected function executeShiftDownQuery($db);
    
    abstract protected function executeShiftQuery($db);
    
    abstract protected function executeSiblingQuery($db);   
    
    function configure() ;  
    function getNode() ;  
    function moveTo($node);    
    function update();    
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
}

