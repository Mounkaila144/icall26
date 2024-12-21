<?php

abstract class mfPagerApi extends mfArray{ 
    
    
     abstract function execute();
    
     protected   $nb_items_by_page=0,
                    $site=null,
                    $parameters=array(),
                    $class=null,
                    $_position=0,
                    $is_executed=false,
                    $count=0,
                    $query,
                    $nb_rows=0,                
                    $page=1,
                    $nb_pages=1;

        public $items=array();
    
    function setNbItemsByPage($nb_items_by_page=10)
        {
            $nb_items_by_page=(string) $nb_items_by_page;
            if (is_numeric($nb_items_by_page) && $nb_items_by_page>1)
                 $this->nb_items_by_page=$nb_items_by_page; //($nb_items_by_page>0)?$nb_items_by_page:1;
            else
                $this->nb_items_by_page="*";
            
        }
        function setPage($page_requested)
        {
           $this->page=($page_requested<=0)?1:$page_requested;   
           return $this;
        }
 
        function getNbItemsByPage()
        {
            return $this->nb_items_by_page;
        }
    
        function getResults()
        {
            return $this->count;
        }

        function getClass()
        {
            return $this->class;
        }

        function getNextPage()
        {
            return $this->next_page;
        }

        function getLastPage()
        {
            return $this->last_page;
        }

        function getPreviousPage()
        {
            return $this->previous_page;
        }

        function getFirstPage()
        {
            return $this->first_page;
        }

        function haveToPaginate()
        {
            return ($this->nb_pages>1);
        }

        function getPages()
        {
            return $this->nb_pages;
        }

        function getPage()
        {
            return $this->page;
        }

        function getNbItems()
        {
            return $this->nb_rows;
        }
        

        function hasItems()
        {
            return ( $this->nb_rows > 0);
        }
    
        function setQuery($query)
        {
           $this->query=$query;       
           return $this;
        }

        function getQuery()
        {
            return $this->query;
        }
               
        function getItems()
        {
           return $this->items;
        }
        
        function process()
        {             
            $this->is_executed=true;
            $this->getResults();           
            if (!$this->count) // No item
            {
                $this->nb_rows=0;
                $this->items=array();
                return $this;
            }                    
            if ($this->nb_items_by_page=="*")
                return ; 
            $this->nb_pages = (int)ceil($this->count / $this->nb_items_by_page);
            if ($this->page>$this->nb_pages) 
                $this->page=$this->nb_pages;
            $offset=($this->page-1)*$this->nb_items_by_page;
            $this->last_page=$this->nb_pages;
            $this->first_page=1;
            $this->previous_page=($this->page-1<1)?1:$this->page-1;
            $this->next_page=($this->page+1>$this->nb_pages)?$this->nb_pages:$this->page+1;             
            return $this;
        }
    
}
