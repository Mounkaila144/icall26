<?php


class ProductCollection extends mfObjectCollection3 {
    
    
    function getProductById($id)
    {
        return isset($this->collection[$id])?$this->collection[$id]:null;
    }
    
    function toArrayForBilling(){        
        foreach ($this->collection as $item){  
            $values[$item->get('id')]=$item->toArray();
            $values[$item->get('id')]['services']=$item->services->toArrayForBilling();  
            $values[$item->get('id')]['count_services']=$item->services->count();
        }
        return $values;
    }
    
    
    function getItems()
    {
        if ($this->items===null)
        {
            $this->items=new ProductItemCollection(null,$this->getSite());
            foreach ($this as $product)
            {
                foreach ($product->getProductItems() as $item)
                    $this->items[$item->get('id')]=$item;
            }    
        }   
        return $this->items;
    }
    
    
    function getMasterItems()
    {
        if ($this->master_items===null)
        {
           $this->master_items=new ProductItemCollection();
           foreach ($this as $product)
           {
              foreach ($product->getProductItems() as $item)
              {
                  if ($item->getItems()->getSlaves()->isEmpty())
                     continue; 
                  $item->set('product_id',$product);
                  $this->master_items[]=$item;                  
              }                                  
           }    
        }
        return $this->master_items;
    }
    
                
    function byMasters()
    {
        if ($this->by_masters===null)
        {
            $this->by_masters=new ProductCollection(null,$this->getSite());
             foreach ($this as $product)
            {                
                 if ($product->getProductItems()->hasMaster())                
                   $this->by_master[$product->get('id')]=$product;
            }  
            foreach ($this as $product)
            {                
                 if (!$product->getProductItems()->hasMaster())                
                   $this->by_masters[$product->get('id')]=$product;
            } 
        }
        return $this->by_masters;
    }
    
   /* function withMasterItems()
    {
        if ($this->with_master_items===null)
        {
           $this->with_master_items=new ProductItemCollection();
           foreach ($this as $product)
           {
              foreach ($product->getProductItems() as $item)
              {
                  if ($item->getItems()->getSlaves()->isEmpty())
                     continue; 
                  $item->set('product_id',$product);
                  $this->with_master_items[]=$item;                  
              }                                  
           }    
        }
        return $this->with_master_items;
    }*/
    
    
    function getMasters()
    {
        if ($this->masters===null)
        {    
            $this->masters=new ProductItemCollection();
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array())  
                ->setObjects(array('ProductItem','Product'))
                ->setQuery("SELECT {fields} FROM ".ProductItem::getTable(). 
                           " INNER JOIN ".ProductItemsItem::getInnerForJoin('item_master_id').
                           " INNER JOIN ".ProductItem::getOuterForJoin('product_id').
                           " WHERE ".ProductItem::getTableField('product_id')." IN('".$this->getKeys()->implode("','")."')".
                           " GROUP BY ".ProductItem::getTableField('id').
                           " ORDER BY ".ProductItem::getTableField('position')." ASC ".                           
                           ";")
                ->makeSiteSqlQuery($this->getSite());
           //  echo $db->getQuery();
            if (!$db->getNumRows())
                   return $this->masters;     
           while ($items=$db->fetchObjects())
          {
              $item=$items->getProductItem();    
              $item->set('product_id',$items->getProduct());
              $item->getMastersAndSlaves()->push($item);             
              $this->masters[$item->get('id')]=$item->set('is_default','YES'); 
          }  
          
          $db=mfSiteDatabase::getInstance()
                 ->setParameters(array())  
                ->setObjects(array('ProductItem'))
                ->setQuery("SELECT {fields},item_master_id FROM ".ProductItem::getTable(). 
                           " INNER JOIN ".ProductItemsItem::getInnerForJoin('item_slave_id').                       
                           " WHERE item_master_id IN('".$this->masters->getKeys()->implode("','")."')".                                                                               
                           ";")
                ->makeSiteSqlQuery($this->getSite());
         //   echo $db->getQuery();
          while ($items=$db->fetchObjects())
          {              
              $this->masters[$items->get('item_master_id')]->getMastersAndSlaves()->push($items->getProductItem());                   
          } 
        }
        return $this->masters;
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
    
    function getReferences()
    {
        if ($this->references===null)
        {    
            $this->references=new mfArray();
            foreach ($this as $item)
                $this->references[$item->get('id')]=$item->get('reference');
        }
        return $this->references;
    }
    
   /* function search($query,$field='reference')
    {
          $values=new mfArray();
       
      
          return $values;
    }*/
}

