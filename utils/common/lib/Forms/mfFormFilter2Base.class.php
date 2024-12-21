<?php

class mfFormFilter2Base extends mfFormFilterBase {
    
    
    function setQuery($query)
    { 
      $this->_query=$query;
      return $this;
    }
    
    function getQuery()
    {
         if ($this->query_valid)
            return $this->_query; 
         $this->query=(string)$this->_query;
         parent::getQuery();
         return $this->query;
    }
}