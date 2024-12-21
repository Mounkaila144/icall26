<?php



class ProductItemsItemBase extends orderedObject {
     
    protected static $fields=array('item_master_id','item_slave_id','is_active','status','position',
                                   'created_at','updated_at');
    const table="t_products_items_item"; 
    protected static $foreignKeys=array(
                                        'item_master_id'=>'ProductItem',
                                        'item_slave_id'=>'ProductItem'); // By default   
    protected static $fieldsNull=array('updated_at'); // By default
     
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']);          
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);       
      }   
    }
        
   
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
      $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
      $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
      $this->is_active=isset($this->is_active)?$this->is_active:"YES";      
      $this->status=isset($this->status)?$this->status:"ACTIVE";
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
       $this->set('updated_at',date("Y-m-d H:i:s"));   
    }   
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!={id};":"";
      $db->setParameters(array('reference'=>$this->get('reference'),'mark'=>$this->get('mark'),'id'=>$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE reference='{reference}' AND mark='{mark}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    protected function executeLastPositionQuery($db)
    {
     $db->setParameter('item_master_id',$this->get('item_master_id'))
        ->setQuery("SELECT max(position) FROM ".static::getTable()." WHERE item_master_id='{item_master_id}';")
         ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeShiftUpQuery($db)
    {
       $db->setParameter('item_master_id',$this->get('item_master_id'))
           ->setQuery("UPDATE ".static::getTable()." SET position=position + 1 WHERE position < %d AND position >= %d AND item_master_id='{item_master_id}';")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeShiftDownQuery($db)
    {
        $db->setParameter('item_master_id',$this->get('item_master_id'))
                ->setQuery("UPDATE ".static::getTable()." SET position=position - 1 WHERE position > %d AND position <= %d AND item_master_id='{item_master_id}';")
             ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeShiftQuery($db)
    {
        $db->setParameter('item_master_id',$this->get('item_master_id'))
                ->setQuery("UPDATE ".static::getTable()." SET position=position - 1 WHERE position > %d  AND item_master_id='{item_master_id}';")
            ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeSiblingQuery($db)
    {
       $db->setParameter('item_master_id',$this->get('item_master_id'))
               ->setQuery("SELECT * FROM ".static::getTable()." WHERE position={position} AND item_master_id='{item_master_id}';")
           ->makeSiteSqlQuery($this->site);   
    }
   
    function disable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','NO');
        $this->save();
    }
    
    function enable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','YES');
        $this->save();
    }
   
            
    function getMaster()
    {
       return $this->_item_master_id = $this->_item_master_id ===null?new ProductItem($this->get('item_master_id'),$this->getSite()):$this->_item_master_id ;
    }  
    
   function getSlave()
    {
       return $this->_item_slave_id = $this->_item_slave_id ===null?new ProductItem($this->get('item_slave_id'),$this->getSite()):$this->_item_slave_id ;
    }
    
    function toArrayForXML(){
        $item= parent::toArray();
        $item['master']= $this->getMaster()->get('reference');
        $item['slave']= $this->getSlave()->get('reference');
        return $item ;
    }
    
    static function getMasterForItemsForPager($pager)
    {
        $keys=new mfArray($pager->getKeys());
        foreach ($pager as $item)
             $item->is_master=false;
        $db= mfSiteDatabase::getInstance();
            $db->setParameters(array())
                ->setQuery( "SELECT item_master_id FROM ". ProductItemsItem::getTable().
                            " WHERE item_master_id IN('".$keys->implode("','")."')".
                            ";"
                        )
                ->makeSiteSqlQuery($pager->getSite());
            if (!$db->getNumRows())
              return ;
            while ($row=$db->fetchArray())
            {        
                if (isset($pager[$row['item_master_id']]))
                    $pager[$row['item_master_id']]->is_master=true;
            }        
    }
}
