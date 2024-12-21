<?php


class ProductItemCollection extends mfObjectCollection3 {
    
    protected $data=null;
            
    function __construct($data=null,$site=null) {        
        if ($data instanceof ProductItem)
        {  
           parent::__construct(null, $site);
           $this->data=$data;
           return ;
        } 
        if ($data instanceof Product)
        {          
           parent::__construct(null, $site);
           $this->data=$data;
           return ;
        } 
         if ($data instanceof ProductItemCollection)
        {          
           parent::__construct(null, $site);
           $this->data=$data;
           return ;
        } 
        parent::__construct($data, $site);
    }
 /*   
    protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSiteSqlQuery($this->site);   
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }            
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuery($this->site); 
    }
    */
    
    function getItemById($id)
    {
        return isset($this->collection[$id])?$this->collection[$id]:null;
    }
    
           
    function hasMaster()
    {
        if ($this->has_master===null)
        {
            $this->has_master=false;
            foreach ($this as $item)
            {
                 if ($item->isMaster())
                 {
                     $this->has_master=true;
                     break;
                 }       
            }
        }   
        return $this->has_master;
    }
    
    function uasort($a,$b)
    {        
        if ($a->get('reference') == $b->get('reference'))  
            return 0;            
        return $a->get('reference') < $b->get('reference') ? -1 : 1;      
    }
    
    function sortByReference()
    {
        uasort($this->collection, array($this,'uasort'));                
        return $this;
    }
    
    function hasItemByKey($key)
    {
        return (boolean) $this->getItemByKey($key);
    }
    
     function uasortIsActive($a,$b)
    {        
        if ($a->get('is_active') == $b->get('is_active'))  
            return 0;            
        return $a->get('is_active') > $b->get('is_active') ? -1 : 1;      
    }
    
    function sortByIsActive()
    {
        uasort($this->collection, array($this,'uasortIsActive'));                
        return $this;
    }
    
     
   function uasortReferenceIsActive($a,$b)
    {        
        if ($a->getProduct()->get('reference').$a->get('reference') == $b->getProduct()->get('reference').$b->get('reference'))
        {
             if ($a->get('is_active') == $b->get('is_active'))
                return 0;
            return $a->get('is_active') > $b->get('is_active') ? -1 : 1;
        }

        if ($a->getProduct()->get('reference').$a->get('reference') <  $b->getProduct()->get('reference').$b->get('reference'))
        {
            if ($a->get('is_active') == $b->get('is_active'))
                return -1;
            return $a->get('is_active') > $b->get('is_active') ? -1 : 1;
        }
        else
        {
           if ($a->get('is_active') == $b->get('is_active'))
                return 1;
            return $a->get('is_active') > $b->get('is_active') ? -1 : 1;
        }
    }
    
    function sortByReferenceIsActive()
    {
        uasort($this->collection, array($this,'uasortReferenceIsActive'));
        return $this;
    } 
    
    
    function getAll()
    {
        if ($this->isLoaded())
            return $this;
        if ($this->data instanceof Product && $this->data->isLoaded())
        {    
           $db=mfSiteDatabase::getInstance()
                ->setParameters(array('product_id'=> $this->data->get('id')))                        
                ->setQuery("SELECT ".ProductItem::getFieldsAndKeyWithTable()." FROM ".ProductItem::getTable().                                  
                           " WHERE product_id ='{product_id}'".     
                           " AND ".ProductItem::getTableField('is_active')."='YES'".
                           " AND ".ProductItem::getTableField('status')."='ACTIVE'".
                           ";")
                ->makeSiteSqlQuery($this->getSite());   
            if (!$db->getNumRows())
                return $this;        
            while ($item=$db->fetchObject('ProductItem'))
            {
               $this[$item->get('id')]=$item;
            }  
            $this->loaded();
        }
        if ($this->data instanceof ProductItem && $this->data->isLoaded())
        {   
            $db=mfSiteDatabase::getInstance()
                ->setParameters(array('master_id'=> $this->data->get('id'))) 
                ->setQuery("SELECT ".ProductItem::getFieldsAndKeyWithTable().",item_master_id as is_master FROM ".ProductItem::getTable().    
                           " INNER JOIN ".ProductItemsItem::getInnerForJoin('item_slave_id').
                           " WHERE ".ProductItemsItem::getTableField('item_master_id')."='{master_id}'".      
                           " AND ".ProductItem::getTableField('status')."='ACTIVE'".
                           " ORDER BY ".ProductItem::getTableField('position')." ASC ".
                           ";")
                ->makeSiteSqlQuery($this->data->getSite());   
            //echo $db->getQuery();
              if (!$db->getNumRows())
                  return $this;        
              while ($item=$db->fetchObject('ProductItem'))
              {
                 $this[$item->get('id')]=$item->loaded()->setSite($this->data->getSite());
              }  
              $this->loaded();
        }            
        return $this;
    }
    
    
    function byIndex()
    {
        if ($this->by_index===null)
        {
            $this->by_index=new $this($this->data);
            foreach ($this as $item)
              $this->by_index[] =$item;          
        }    
        return $this->by_index;
    }
    
    function save()
    {               
        if ($this->data instanceof ProductItem)
        {                     
            $items_keys=new mfArray(array($this->data->get('id'))); 
            foreach ($this as $item)                      
               $items_keys[]= $item->get('id');            
            // supression de tous items si collection vide         
            if ($items_keys->isEmpty())
            {
               $db=mfSiteDatabase::getInstance()           
                    ->setParameters(array('product_id'=>$this->data->get('product_id'),'master_id'=>$this->data->get('id')))              
                    ->setQuery("UPDATE ". ProductItem::getTable().
                               " INNER JOIN ".ProductItemsItem::getInnerForJoin('item_slave_id').
                               " SET ".ProductItem::getTableField('status')."='DELETE'".
                               " WHERE ".ProductItem::getTableField('product_id')."='{product_id}'".
                               " AND ". ProductItemsItem::getTableField('item_master_id')."='{master_id}'".
                               " ;")
                    ->makeSiteSqlQuery($this->getSite());   
               // master / slave
               $db ->setParameters(array('item_master_id'=>$this->data->get('id')))                        
                ->setQuery("DELETE FROM ".ProductItemsItem::getTable().                                  
                           " WHERE item_master_id='{item_master_id}'". 
                           ";")
                ->makeSiteSqlQuery($this->getSite());                   
               
               return $this;
            }
            // Delete items not used   // ids - delete non inclus dans cette collection            
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('product_id'=>$this->data->get('product_id'),'master_id'=>$this->data->get('id')))              
                ->setQuery("UPDATE ". ProductItem::getTable(). 
                           " INNER JOIN ".ProductItemsItem::getInnerForJoin('item_slave_id').
                           " SET ".ProductItem::getTableField('status')."='DELETE'".
                           " WHERE ".ProductItem::getTableField('product_id')."='{product_id}' AND ". ProductItem::getTableField('id')." NOT IN('".$items_keys->implode("','")."')".
                           " AND ". ProductItemsItem::getTableField('item_master_id')."='{master_id}'".
                           " ;")
                ->makeSiteSqlQuery($this->getSite());
            
            // master / slave
            $db ->setParameters(array('item_master_id'=>$this->data->get('id')))                        
                ->setQuery("DELETE FROM ".ProductItemsItem::getTable().                                  
                           " WHERE item_master_id='{item_master_id}' AND item_slave_id NOT IN('".$items_keys->implode("','")."')". 
                           ";")
                ->makeSiteSqlQuery($this->getSite());   
            
             parent::save(); 
                          
            // collection items modifiÃƒÂ©es + nouveau items
                                   
            $db ->setParameters(array('item_master_id'=>$this->data->get('id')))                              
                   ->setQuery("SELECT item_slave_id FROM ".ProductItemsItem::getTable().                                  
                              " WHERE item_master_id='{item_master_id}' AND item_slave_id IN('".$items_keys->implode("','")."')".                                
                              ";")
                   ->makeSiteSqlQuery($this->getSIte()); 

           $keys=new mfArray();
           foreach ($this->getAll() as $item){
               $keys[]=$item->get('id');
           }
           $keys->findAndRemove($this->data->get('id'));
           if ($db->getNumRows())
           {            
               while ($row=$db->fetchArray())
               {
                   $keys->findAndRemove($row['item_slave_id']);
               }
           }
           $items_collection = new ProductItemsItemCollection(null,$this->getSite());
           foreach ($keys as $slave_item)
           {
               //echo $slave_item;
               $item= new ProductItemsItem(null,$this->getSite());
               $item->add(array('item_slave_id'=>$slave_item,'item_master_id'=>$this->data));
               $items_collection[]=$item;
           }    
           $items_collection->save();
            
            return $this;
        }   
        parent::save();
        return $this;
    }
    
    function findAndRemove($key){
        if(!isset($this->collection[$key]))
            return $this;
        unset($this->collection[$key]);
    }
    
    function getMasters(){
        
        return $this->masters=$this->masters===null?new $this($this,$this->getSite()):$this->masters;
    }
    
    
    function bySlave()
    {
        if ($this->by_slave===null)
        {    
            $this->by_slave=$this->data;
            // data = slaves
            if ($this->data instanceof ProductItemCollection && $this->data->isLoaded())
            {
                 $db=mfSiteDatabase::getInstance()
                ->setParameters(array()) 
                ->setQuery("SELECT ".ProductItem::getFieldsAndKeyWithTable().",item_slave_id  FROM ".ProductItem::getTable().    
                           " INNER JOIN ".ProductItemsItem::getInnerForJoin('item_master_id').
                           " WHERE ".ProductItemsItem::getTableField('item_slave_id')." IN('".$this->data->getKeys()->implode("','")."')".      
                                " AND ".ProductItem::getTableField('status')."='ACTIVE'".
                           " ORDER BY ".ProductItem::getTableField('position')." ASC ".
                           ";")
                ->makeSiteSqlQuery($this->data->getSite());   
          //   echo $db->getQuery();
              if (!$db->getNumRows())
                  return $this;        
              while ($item=$db->fetchObject('ProductItem'))
              {                  
                  if (!$this->data->hasItemByKey($item->get('item_slave_id')))
                      continue;
                   $this->data[$item->get('item_slave_id')]->getMasters()->push($item->loaded());             
              }               
            }        
        }                
        return $this->data;
    }
    
    function create()
    {
        parent::save();
        // create links items
        if ($this->data instanceof ProductItem)
        {
            
            $items_collection = new ProductItemsItemCollection(null,$this->getSite());
            foreach ($this->data->getSlaves() as $slave){
               $item= new ProductItemsItem(null,$this->getSite());
               $item->add(array('item_slave_id'=>$slave,'item_master_id'=>$this->data));
               $items_collection[]=$item;
            }
            $items_collection->save();
        }
        
        return $this;
    }
}

