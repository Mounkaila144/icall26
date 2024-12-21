<?php

class PagerCsvFile implements ArrayAccess ,Iterator, Countable {
    
    protected   $nb_items_by_page=0,
                $_position=0,
                $is_executed=false,
                $header_raded=false,
                $count=0,
                $nb_rows=0,                
                $page=1,
                $nb_pages=1,
                $file = null,
                $import_file=null,
                $header="",
                $path="";
    
    public $items=array();

    function __construct($import_file,$nb_items_by_page=50)
    {
        $this->import_file=$import_file;
        $this->path = $this->import_file->getLogFile()->getPath()."/".$this->import_file->get('file_log');
        $this->file = new CsvImport($this->path,array());
        $this->file->setSchema(array_merge($this->import_file->getSchema(),array("import status"=>"import status","mode"=>"mode")));
        $this->file->open();
        $this->setNbItemsByPage($nb_items_by_page);
    }
    
    function setNbItemsByPage($nb_items_by_page=10)
    {
        $nb_items_by_page=(string) $nb_items_by_page;
        if (is_numeric($nb_items_by_page) && $nb_items_by_page>1)
            $this->nb_items_by_page=$nb_items_by_page;
    }   
            
    function setPage($page_requested)
    {
       $this->page=($page_requested<=0)?1:$page_requested;       
    }
 
    function getNbItemsByPage()
    {
        return $this->nb_items_by_page;
    }
    
    function getResults()
    {
        return $this->count;
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
    
    function getBeginNumberResult()
    {
        return 1+($this->getNbItemsByPage()*($this->getPage()-1));
    }
    
    function getEndNumberResult()
    {
        $end=$this->getNbItemsByPage()*$this->getPage(); 
        if ($end>$this->getResults()||$this->getNbItemsByPage()=="*")  
            return $this->getResults();
        return $end;
    }
    
    protected function _getCount()
    {       
        $file = new CsvFile($this->path,"r");
        $this->count=$file->getNumberOfLines();
    }
    
    function getItems()
    {
        return $this->items;
    }
    
    protected function getCount()
    {
        return $this->count;
    }        
    
    protected function prepareForExecute()
    {
        $this->is_executed=true;
        $this->_getCount();
        if (!$this->count) // No item
        {
            $this->nb_rows=0;
            $this->items=array();
            return;
        }
        
        $this->nb_pages = (int)ceil($this->count / $this->nb_items_by_page);
        if ($this->page>$this->nb_pages) 
            $this->page=$this->nb_pages;
        $offset=($this->page-1)*$this->nb_items_by_page;
        $this->last_page=$this->nb_pages;
        $this->first_page=1;
        $this->previous_page=($this->page-1<1)?1:$this->page-1;
        $this->next_page=($this->page+1>$this->nb_pages)?$this->nb_pages:$this->page+1;              
    }
              
    
    function execute($application=null,$site=null)
    {   
        $this->prepareForExecute();
        try
        {            
            if ($this->import_file->hasHeader())
            {    
                $this->file->readHeader();          
                $this->header = $this->file->getHeader();
            }     
            $this->file->seek((($this->page-1)*$this->nb_items_by_page)+1);
            $max_lines= $this->getNbItemsByPage();
            
            while (($line=$this->file->fetchArray()) &&  $max_lines--!=0)
            {
                $this->items[] = $line;
            }
            $this->nb_rows = count($this->items);
        }
        catch (mfException $e)
        {
            throw $e;
        }
        return $this;
    }
    
    function getFirstItem()
    {
        reset($this->items);
        return (current($this->items))?current($this->items):null;
    }
    
    public function offsetSet($offset, $value)
    {
        throw new LogicException('Cannot update multiple objects fields (read-only).');
    }

    public function offsetUnset($offset)
    {
        throw new LogicException('Cannot remove multiple objects fields (read-only).');
    }

    public function offsetExists($name)
    {
        return isset($this->items[$name]);
    }

    public function offsetGet($name)
    {
        return $this->items[$name]; 
    }

    public function count()
    {
        return count($this->items);
    }


    public function rewind()
    {
        reset($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function current()
    {
        return current($this->items); 
    }

    public function next()
    {
        return next($this->items); 
    }

    public function valid()
    {
        $key = key($this->items);
        return ($key !== NULL && $key !== FALSE);
    }
    
    function isExecuted()
    {
        return $this->is_executed;
    }

    function isEmpty()
    {
        return empty($this->items);
    }
    
    function getHeader()
    {
        return $this->header;
    }
}
