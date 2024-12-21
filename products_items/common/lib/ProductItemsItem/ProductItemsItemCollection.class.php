<?php


class ProductItemsItemCollection extends mfObjectCollection3 {
    
    protected $items=null;
    
    function __construct($data=null,$site=null)
    {
        if ($data instanceof ProductItemCollection)
        {
            $this->items=$data;
            return  parent::__construct(null,$site); 
        }    
        parent::__construct($data,$site);
    }  
    
    function getItems()
    {
        if ($this->items===null)
        {
            $this->items=new ProductItemCollection();             
        }    
        return $this->items;
    }
    
    function getMasters()
    {
        if ($this->masters===null)
        {
            $this->masters=new ProductItemCollection();
            foreach ($this as $item)
            {
                $this->masters[]=$item->getMaster();
            }    
        }    
        return $this->masters;
    }
    
     function getSlaves()    
    {                
        $values=new mfArray();
        foreach ($this as $item)
            $values[]=array('id'=>$item->get('item_slave_id'),'is_default'=>$item->getSlave()->isDefault());       
        return $values;
    }
     
    
    function withSlaves()    
    {     
        if ($this->with_slaves === null)
        {    
            $this->with_slaves=new ProductItemCollection();
            foreach ($this as $item)
            {
                $this->with_slaves[]=$item->getSlave();
            }          
        }
        return $this->with_slaves;
    } 
    
    function bySlaves()
    {
        $values=new mfArray();
        foreach ($this as $item)
            $values[]=$item->get('item_slave_id');
        return $values;
    }
    
    function addItem($item){
        if(!isset($this->collection[$item->get('id')]))
            $this->collection[$item->get('id')]=$item;
        return $this;
    }
       
    
    
    function import($links)
    {
        if (!$this->getItems()) 
           return $this;
        
        foreach($links->link as $link){
            if($this->getItems()->hasItemByKey((string)$link->master))            
                $master= $this->getItems()->getItemByKey((string)$link->master);
        //     echo "<pre>";var_dump($slave);
            if($this->getItems()->hasItemByKey((string)$link->slave))   
                $slave= $this->getItems()->getItemByKey((string)$link->slave);
         //  echo "<pre>";var_dump($slave->isNotLoaded());
         //   echo "<pre>";var_dump($master->isNotLoaded());
            if($slave->isNotLoaded() || $master->isNotLoaded())
                continue;
            $items_item =new ProductItemsItem();
            $items_item->add((array)$link);
            $items_item->set('item_master_id',$master);
            $items_item->set('item_slave_id',$slave);            
            $this->collection[]=$items_item;
        }
        return $this;
    }
    
    function getAll(){
        
        if($this->getItems() instanceof ProductItemCollection){
            foreach ($this->getItems() as $item)
            {
                $db=mfSiteDatabase::getInstance()
                ->setParameters(array()) 
                ->setQuery("SELECT ".ProductItemsItem::getFieldsAndKeyWithTable()." FROM ".ProductItemsItem::getTable().   
                           " WHERE ".ProductItemsItem::getTableField('item_slave_id')." IN (".$this->getItems()->getKeys()->implode(",").")".  
                           ";")
                ->makeSiteSqlQuery($this->getSite());   
            echo $db->getQuery();
              if (!$db->getNumRows())
                  return $this;        
              while ($item=$db->fetchObject('ProductItemsItem'))
              {
                 $this[$item->get('id')]=$item->loaded();
              }  
              $this->loaded();
            }
        }
    }

    
}

