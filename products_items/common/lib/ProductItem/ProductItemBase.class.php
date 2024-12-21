<?php



class ProductItemBase extends orderedObject {
     
    protected static $fields=array('tva_id','product_id','description','reference','sale_price','purchasing_price',
                                   'input1','input2','picture','icon','unit','content','details','is_active','status',
                                   'coefficient','is_mandatory','linked_id','is_multiple','multiple',
                                   'thickness','mark','input3','discount_price','is_default','position','layer_process',
                                   'input4','input5','input6','input7',
                                   'created_at','updated_at');
    const table="t_products_item"; 
    protected static $foreignKeys=array('tva_id'=>'Tax','linked_id'=>'ProductItem',
                                        'product_id'=>'Product'); // By default   
    protected static $fieldsNull=array('linked_id','description'); // By default
     
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']);      
          if (isset($parameters['reference']))
             return $this->loadbyReference((string)$parameters['reference']);      
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);       
      }   
    }
        
      protected function loadByReference($reference)
    {
         $this->set('reference',$reference);         
         $db=mfSiteDatabase::getInstance()->setParameters(array('reference'=>$reference));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE reference='{reference}';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
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
      $this->is_mandatory=isset($this->is_mandatory)?$this->is_mandatory:"NO";
      $this->purchasing_price=isset($this->purchasing_price)?$this->purchasing_price:0.0;
      $this->sale_price=isset($this->sale_price)?$this->sale_price:0.0;
      $this->coefficient=isset($this->coefficient)?$this->coefficient:1.0;
      $this->status=isset($this->status)?$this->status:"ACTIVE";
      $this->is_multiple=isset($this->is_multiple)?$this->is_multiple:"NO";
      $this->is_default=isset($this->is_default)?$this->is_default:"YES";
      $this->multiple=isset($this->multiple)?$this->multiple:0.0;
      $this->thickness=isset($this->thickness)?$this->thickness:0.0;
      $this->discount_price=isset($this->discount_price)?$this->discount_price:0.0;
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
     $db->setParameter('product_id',$this->get('product_id'))
        ->setQuery("SELECT max(position) FROM ".static::getTable()." WHERE product_id='{product_id}';")
         ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeShiftUpQuery($db)
    {
       $db->setParameter('product_id',$this->get('product_id'))
           ->setQuery("UPDATE ".static::getTable()." SET position=position + 1 WHERE position < %d AND position >= %d AND product_id='{product_id}';")
            ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeShiftDownQuery($db)
    {
        $db->setParameter('product_id',$this->get('product_id'))
                ->setQuery("UPDATE ".static::getTable()." SET position=position - 1 WHERE position > %d AND position <= %d AND product_id='{product_id}';")
             ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeShiftQuery($db)
    {
        $db->setParameter('product_id',$this->get('product_id'))
                ->setQuery("UPDATE ".static::getTable()." SET position=position - 1 WHERE position > %d  AND product_id='{product_id}';")
            ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeSiblingQuery($db)
    {
       $db->setParameter('product_id',$this->get('product_id'))
               ->setQuery("SELECT * FROM ".static::getTable()." WHERE position={position} AND product_id='{product_id}';")
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
   
     function hasTax()
    {
       return (boolean)$this->_tva_id; 
    }
    
      function getTax()
    {
       if ($this->_tva_id ===null)
       {
          $this->_tva_id=new Tax($this->get('tva_id'),$this->getSite());          
       }   
       return $this->_tva_id;
    }  
    
    
    function getProduct()
    {
       if ($this->_product_id ===null)
       {
          $this->_product_id=new Product($this->get('product_id'),$this->getSite());          
       }   
       return $this->_product_id;
    }  
    
    function getLinkedItem()
    {
       if ($this->_linked_item_id ===null)
       {
          $this->_linked_item_id=new ProductItem($this->get('linked_id'),$this->getSite());          
       }   
       return $this->_linked_item_id;
    }  
    
   /* function getFormattedSalePrice()
    {
        return format_number($this->get('sale_price'),"#.00");
    }
    
    function getFormattedPurchasingPrice()
    {
        return format_number($this->get('purchasing_price'),"#.00");
    }*/
    
   
    
    
    static function loadProductsAndItemsForMeeting($meeting,$products_necessary)
    {
        $meeting->active_meeting_products=new ProductCollection(null,$meeting->getSite());
        $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('meeting_id'=>$meeting->get('id')))      
                         ->setObjects(array('Product','ProductItem'))
                         ->setQuery("SELECT {fields} FROM ".CustomerMeetingProduct::getTable().
                                    " INNER JOIN ".CustomerMeetingProduct::getOuterForJoin('product_id').
                                    " INNER JOIN ".self::getInnerForJoin('product_id').
                                    " WHERE meeting_id='{meeting_id}' AND ".Product::getTableField('id')." IN('".$products_necessary->implode("','")."')".
                                        " AND ".Product::getTableField('is_active')."='YES'".
                                        " AND ".ProductItem::getTableField('is_active')."='YES'".
                                    ";")
                         ->makeSiteSqlQuery($meeting->getSite());                
                if (!$db->getNumRows())
                  return $meeting->active_meeting_products;               
               while ($items=$db->fetchObjects())
               {                          
                   
                   if (!isset($meeting->active_meeting_products[$items->getProduct()->get('id')]))
                      $meeting->active_meeting_products[$items->getProduct()->get('id')]=$items->getProduct();
                   $meeting->active_meeting_products[$items->getProduct()->get('id')]->addItem($items->getProductItem());
               } 
    }
    
    static function loadProductsAndItemsForContract(CustomerContract $contract,$products_necessary)
    {      
        $contract->active_contract_products=new ProductCollection(null,$contract->getSite());
        $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('contract_id'=>$contract->get('id')))      
                         ->setObjects(array('Product','ProductItem'))
                         ->setQuery("SELECT {fields} FROM ".CustomerContractProduct::getTable().
                                    " INNER JOIN ".CustomerContractProduct::getOuterForJoin('product_id').
                                    " INNER JOIN ".self::getInnerForJoin('product_id').
                                    " WHERE contract_id='{contract_id}' AND ".Product::getTableField('id')." IN('".$products_necessary->implode("','")."')".
                                        " AND ".Product::getTableField('is_active')."='YES'".
                                        " AND ".ProductItem::getTableField('is_active')."='YES'".
                                    ";")
                         ->makeSiteSqlQuery($contract->getSite());   
                if (!$db->getNumRows())
                  return $meeting->active_contract_products;               
               while ($items=$db->fetchObjects())
               {                          
                   
                   if (!isset($contract->active_contract_products[$items->getProduct()->get('id')]))
                      $contract->active_contract_products[$items->getProduct()->get('id')]=$items->getProduct();
                   $contract->active_contract_products[$items->getProduct()->get('id')]->addItem($items->getProductItem());
               }        
    }
    
  /*  static function loadItemsForProducts($products,$site=null)
    {                
        $db=mfSiteDatabase::getInstance()
                         ->setParameters(array())                        
                         ->setQuery("SELECT ".ProductItem::getFieldsAndKeyWithTable()." FROM ".ProductItem::getTable().                                  
                                    " WHERE product_id IN('".implode("','",$products->getKeys())."')".                                        
                                    ";")
                         ->makeSiteSqlQuery($site);   
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return ;        
        while ($item=$db->fetchObject('ProductItem'))
        {
           $products[$item->get('product_id')]->addItem($item);
        }     
      //  echo "<pre>"; var_dump($products); echo "</pre>"; 
    }*/
    
    static function getItemsActiveForProductForSelect($product)
    {                       
        $values=new mfArray();
        if (!$product || $product->isNotLoaded())
            return $values;
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('product_id'=>$product->get('id')))                        
                ->setQuery("SELECT ".ProductItem::getFieldsAndKeyWithTable()." FROM ".ProductItem::getTable().                                  
                           " WHERE product_id ='{product_id}'".     
                           " AND ".ProductItem::getTableField('is_active')."='YES'".
                           ";")
                ->makeSiteSqlQuery($product->getSite());   
          if (!$db->getNumRows())
            return $values;        
        while ($item=$db->fetchObject('ProductItem'))
        {
           $values[$item->get('id')]=strtoupper($item->get('reference'));
        }  
        return $values;
    }
    
    static function getItemsActiveForProductIdForSelect($product_id,$site=null)
    {                        
        $values=new mfArray();       
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('product_id'=>$product_id))                        
                ->setQuery("SELECT ".ProductItem::getFieldsAndKeyWithTable()." FROM ".ProductItem::getTable().                                  
                           " WHERE product_id ='{product_id}'".     
                           " AND ".ProductItem::getTableField('is_active')."='YES'".
                           ";")
                ->makeSiteSqlQuery($site);   
          if (!$db->getNumRows())
            return $values;        
        while ($item=$db->fetchObject('ProductItem'))
        {
           $values[$item->get('id')]=strtoupper($item->get('reference'));
        }  
        return $values;
    }
    
    function toArrayForDocument()
    {       
        $values = $this->toArray(array(
            'description','reference','sale_price','purchasing_price','discount_price',
            'input1','input2','unit','content','details',  'thickness','mark','input3', 'input4','input5','input6','input7',                           
        ));
        foreach (array( //'description'=>'FormattedDescription',  
                       'thickness'=>'FormattedThickness'
                    ) as $name=>$method)
        {
            $method='get'.$method;
            $values[$name]=$this->$method();
        }         
        return $values;
    }
    
    function getSettings()
    {
        if ($this->settings===null)
        {
            $this->settings=new ProductItemSettings(null,$this->getSite());
        }    
        return $this->settings;
    }
    
    function getFormattedDescription()
    {       
       return nl2br($this->get('description'));
      //  return str_replace(array("\r\n", "\n", "\r"), "<br/>", $this->get('description'));
    }
    
    function getFormattedThickness()
    {       
        return format_number($this->get('thickness'),"#");
    }   
    
    function getSalePrice()
    {
        return floatval($this->get('sale_price'));
    }
    
    function getSalePriceWithTax()
    {
        if ($this->getSettings()->isCalculationByTTC())
             return $this->getSalePrice(); 
        return $this->getSalePriceWithoutTax() * (1 + $this->getTax()->getRate());
    }
    
    function getSalePriceWithoutTax()
    {
        if ($this->getSettings()->isCalculationByTTC())
            return $this->get('sale_price') / (1 + $this->getTax()->getRate());            
        return $this->getSalePrice();
    }
    
    function getPurchasePrice()
    {
        return floatval($this->get('purchasing_price'));
    }
    
    function getPurchasePriceWithTax()
    {
        return $this->getPurchasePriceWithoutTax() * (1 + $this->getTax()->getRate());
    }
    
    function getPurchasePriceWithoutTax()
    {
        return floatval($this->get('purchasing_price'));
    }
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new ProductItemFormatter($this);
        }    
        return $this->formatter;
    }
    
    function isMandatory()
    {
        return $this->get('is_mandatory')=='YES';
    }
    
      function getCoefficient()
    {
        return floatval($this->get('coefficient',1.0));
    }
    
    function getUnitI18n()
    {
        return __($this->get('unit'),array(),'messages','products_items');
    }
    
     function getStatusI18n()
    {
        return __($this->get('status'),array(),'messages','products_items');
    }
    
    
    static function updatePriceFromProduct(mfArray $selection,$site=null)
    {      
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("UPDATE ".ProductItem::getTable().
                           " INNER JOIN ".ProductItem::getOuterForJoin('product_id'). 
                           " SET ".ProductItem::getTableField('tva_id')."=".Product::getTableField('tva_id').",".
                                   ProductItem::getTableField('sale_price')."=".Product::getTableField('price').",".
                                   ProductItem::getTableField('purchasing_price')."=".Product::getTableField('purchasing_price').
                           " WHERE ".ProductItem::getTableField('id')." IN('".$selection->implode("','")."') ".                                                                    
                           ";")               
                ->makeSiteSqlQuery($site); 
        
    }
    
    static function updateDiscountPriceFromProduct(mfArray $selection,$site=null)
    {      
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("UPDATE ".ProductItem::getTable().
                           " INNER JOIN ".ProductItem::getOuterForJoin('product_id'). 
                           " SET ".ProductItem::getTableField('discount_price')."=".Product::getTableField('discount_price').                                 
                           " WHERE ".ProductItem::getTableField('id')." IN('".$selection->implode("','")."') ".                                                                    
                           ";")               
                ->makeSiteSqlQuery($site); 
        
    }
    
    function __toString() {
        return (string)$this->get('reference');
    }
    
     function getDiscountPrice()
    {
        return floatval($this->get('discount_price'));
    }
    
    
    function getFormattedDiscountPriceWithTax()
    {
        return  format_currency($this->getDiscountPriceWithTax(),'EUR');
    }
    
     function getDiscountPriceWithoutTax()
    {
        return floatval($this->get('discount_price'));
    }       
    
    function getDiscountPriceWithTax()
    {
        return $this->getDiscountPrice() * (1 + $this->getTax()->getRate());
    }
    
    static function getItemsByIds(mfArray $ids,$site=null)
    {
         $collection=new ProductItemCollection(null,$site);     
         if ($ids->isEmpty())
             return $collection;
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                        
                ->setQuery("SELECT * FROM ".ProductItem::getTable().                                  
                           " WHERE id IN('".$ids->implode("','")."')".                                
                           ";")
                ->makeSiteSqlQuery($site);   
          if (!$db->getNumRows())
            return $collection;        
        while ($item=$db->fetchObject('ProductItem'))
        {
           $collection[$item->get('id')]=$item->loaded()->setSite($site);
        }  
        return $collection;
        
    }
    
    
    static function getItemsExceptedForSelect($excepted,$site=null)
    {
        if ($excepted instanceof ProductItem)
            $excepted=new mfArray(array($excepted->get('id')));
         $list=new mfArray();
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                        
                ->setQuery("SELECT * FROM ".ProductItem::getTable().                                  
                           " WHERE id NOT IN('".$excepted->implode("','")."')".                                
                           ";")
                ->makeSiteSqlQuery($site);   
          if (!$db->getNumRows())
            return $list;        
        while ($item=$db->fetchObject('ProductItem'))
        {
           $list[$item->get('id')]=$item->get('reference');
        }  
        return $list;
        
    }
    
    function getReference()
    {
        return new mfString($this->get('reference'));
    }
    
    
    static function getItemsForSelect($site=null)
    {        
         $list=new mfArray();
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                        
                ->setQuery("SELECT * FROM ".ProductItem::getTable().                                                                                    
                           ";")
                ->makeSiteSqlQuery($site);   
          if (!$db->getNumRows())
            return $list;        
        while ($item=$db->fetchObject('ProductItem'))
        {
           $list[$item->get('id')]=$item->get('reference');
        }  
        return $list;        
    }
    
    static function getProductsFromItems(mfArray $items,$site=null)
    {       
           $list=new ProductCollection();
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                        
                ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".ProductItem::getTable().                                                                                    
                           " INNER JOIN ".ProductItem::getOuterForJoin('product_id').
                           " WHERE ".ProductItem::getTableField('id')." IN('".$items->implode("','")."')".
                           " ORDER BY ".Product::getTableField('position')." ASC".
                           ";")
                ->makeSiteSqlQuery($site);   
          if (!$db->getNumRows())
            return $list;        
        while ($item=$db->fetchObject('Product'))
        {
           $list[$item->get('id')]=$item->loaded()->setSite($site);
        }  
        return $list;        
    }        
    
    static function getItemsExcepted($excepted,$site=null)
    {
        if ($excepted instanceof ProductItem)
            $excepted=new mfArray(array($excepted->get('id')));
         $list=new mfArray();
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())  
                ->setObjects(array('ProductItem','Product','ProductItemsItem'))
                ->setQuery("SELECT {fields} FROM ".ProductItem::getTable(). 
                           " INNER JOIN ".ProductItem::getOuterForJoin('product_id').
                           " LEFT JOIN ". ProductItemsItem::getInnerForJoin('item_master_id').
                           " WHERE ".ProductItem::getTableField('id')." NOT IN('".$excepted->implode("','")."')".                                
                           " AND ". ProductItemsItem::getTableField('id')." IS NULL ".                                
                           ";")
                ->makeSiteSqlQuery($site);   
          if (!$db->getNumRows())
            return $list; 
        while ($items=$db->fetchObjects())
        {
            $item=$items->getProductItem();
            $item->set('product_id',$items->getProduct());
           $list[$item->get('id')]=$item;
        }  
        return $list;        
    }
    
    function getItems()
    {
       if ($this->items===null)
       {
           $this->items = new ProductItemsItemCollection(null,$this->getSite());
           if ($this->isNotLoaded())
               return $this->items;
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('item_id'=>$this->get('id')))  
                ->setObjects(array('ProductItemsItem','ProductItem'))
                ->setQuery("SELECT {fields} FROM ".ProductItemsItem::getTable().      
                           " INNER JOIN ".ProductItemsItem::getOuterForJoin('item_slave_id').
                           " WHERE item_master_id='{item_id}'". 
                           " ORDER BY ".ProductItem::getTableField('position')." ASC ".
                           ";")
                ->makeSiteSqlQuery($this->getSite());
         if (!$db->getNumRows())
                   return $this->items;     
          while ($items=$db->fetchObjects())
        {
           $item=$items->getProductItemsItem();
           $item->set('item_slave_id',$items->getProductItem());
           $this->items[$item->get('id')]=$item; //$item->loaded()->setSite($this->getSite());
        }     
       }   
       return $this->items;
    }
    
    function updateItems(mfArray $values)
    {
        if ($this->isNotLoaded())
            return $this;
         $db=mfSiteDatabase::getInstance();
        if ($values->isEmpty())
        {
            $db ->setParameters(array('item_id'=>$this->get('id')))                        
                ->setQuery("DELETE FROM ".ProductItemsItem::getTable().                                  
                           " WHERE item_master_id='{item_id}'". 
                           ";")
                ->makeSiteSqlQuery($this->getSite());    
        }   
         $db ->setParameters(array('item_id'=>$this->get('id')))                        
                ->setQuery("DELETE FROM ".ProductItemsItem::getTable().                                  
                           " WHERE item_master_id='{item_id}' AND item_slave_id NOT IN('".$values->implode("','")."')". 
                           ";")
                ->makeSiteSqlQuery($this->getSite());   
         
         $db ->setParameters(array('item_id'=>$this->get('id')))                              
                ->setQuery("SELECT item_slave_id FROM ".ProductItemsItem::getTable().                                  
                           " WHERE item_master_id='{item_id}' AND item_slave_id IN('".$values->implode("','")."')".                                
                           ";")
                ->makeSiteSqlQuery($this->getSIte());   
        if ($db->getNumRows())
        {            
            while ($row=$db->fetchArray())
            {
                $values->findAndRemove($row['item_slave_id']);
            }
        }
        $collection = new ProductItemsItemCollection(null,$this->getSite());
        foreach ($values as $product_item_id)
        {
            $item= new ProductItemsItem(null,$this->getSite());
            $item->add(array('item_slave_id'=>$product_item_id,'item_master_id'=>$this));
            $collection[]=$item;
        }    
        $collection->save();
        return $this;
    }
    
    function isMultiple()
    {
        return $this->get('is_multiple')=='YES';
    }
    
    static function getItemsWithMasterByIds(mfArray $ids,$site=null)
    {
         $collection=new ProductItemCollection(null,$site);     
         if ($ids->isEmpty())
             return $collection;
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                        
                ->setQuery("SELECT ".self::getFieldsAndKeyWithTable().",item_master_id as is_master FROM ".ProductItem::getTable().    
                           " LEFT JOIN ".ProductItemsItem::getInnerForJoin('item_master_id').
                           " WHERE ".ProductItem::getTableField('id')." IN('".$ids->implode("','")."')".      
                           " GROUP BY ".ProductItem::getTableField('id').                          
                           ";")
                ->makeSiteSqlQuery($site);   
          if (!$db->getNumRows())
            return $collection;        
        while ($item=$db->fetchObject('ProductItem'))
        {
           
           $collection[$item->get('id')]=$item->loaded()->setSite($site);
        }  
        return $collection;
        
    }
    
     static function getItemsWithMasterByPositionAndIds(mfArray $ids,$site=null)
    {
         $collection=new ProductItemCollection(null,$site);     
         if ($ids->isEmpty())
             return $collection;
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                        
                ->setQuery("SELECT ".self::getFieldsAndKeyWithTable().",item_master_id as is_master FROM ".ProductItem::getTable().    
                           " LEFT JOIN ".ProductItemsItem::getInnerForJoin('item_master_id').
                           " WHERE ".ProductItem::getTableField('id')." IN('".$ids->implode("','")."')".      
                           " GROUP BY ".ProductItem::getTableField('id').
                           " ORDER BY ".ProductItem::getTableField('position')." ASC".
                           ";")
                ->makeSiteSqlQuery($site);   
          if (!$db->getNumRows())
            return $collection;        
        while ($item=$db->fetchObject('ProductItem'))
        {
           
           $collection[$item->get('id')]=$item->loaded()->setSite($site);
        }  
        return $collection;
        
    }
    
    
    function isMaster()
    {
        if ($this->is_master===null)
        {
            
        }  
        return $this->is_master;
    }
    
    
    function getMultiple()
    {
        return intval($this->get('multiple'));
    }
    
    function isDefault()
    {
        return $this->get('is_default')=='YES';
    }
    
    
    function updatePositions(mfArray $positions)
    {            
         if ($positions->isEmpty())
            return ;
         $db=mfSiteDatabase::getInstance();
         foreach ($positions as $position=>$id)
         {    
                $db->setParameters(array('position'=>$position+1,'id'=>$id,'item_master_id'=>$this->get('id')))
                   ->setQuery("UPDATE ".ProductItemsItem::getTable()." SET position={position} ".
                              " WHERE id={id} AND item_master_id ='{item_master_id}'".                       
                              ";")               
                ->makeSqlQuery(); 
         }                
         // Renumbering the rest if exists
         $db->setQuery("SELECT @position:=".$positions->count().";")
              ->makeSqlQuery();        
         $db->setParameters(array('item_master_id'=>$this->get('id')))
            ->setQuery("UPDATE ".ProductItemsItem::getTable()." SET position=( SELECT @position:=@position+1 ) ".
                      " WHERE id NOT IN('".$positions->implode("','")."') AND item_master_id ='{item_master_id}'".
                      " ORDER BY position".
                      ";")
           ->makeSqlQuery();          
        return $this;
    }
    
    static function getItemsProductExcepted($excepted,$site=null)
    {
        $products=new ProductItemProductCollection(null,$site);
        if ($excepted instanceof ProductItem)
            $excepted=new mfArray(array($excepted->get('id')));
         $list=new mfArray();
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())  
                ->setObjects(array('ProductItem','ProductItemProduct','ProductItemsItem'))
                ->setQuery("SELECT {fields} FROM ".ProductItem::getTable(). 
                           " INNER JOIN ".ProductItem::getOuterForJoin('product_id').
                           " LEFT JOIN ". ProductItemsItem::getInnerForJoin('item_master_id').
                           " WHERE ".ProductItem::getTableField('id')." NOT IN('".$excepted->implode("','")."')".                                
                           " AND ". ProductItemsItem::getTableField('id')." IS NULL ".                                
                           ";")
                ->makeSiteSqlQuery($site);   
          if (!$db->getNumRows())
            return $list; 
        while ($items=$db->fetchObjects())
        {
            if(!isset($products[$items->getProductItemProduct()->get('id')]))
                $products[$items->getProductItemProduct()->get('id')]=$items->getProductItemProduct();
            $products[$items->getProductItemProduct()->get('id')]->addItemsExcepted($items->getProductItem());
        }  
        return $products;        
    }
    
    function getProductItemSlaves(){
        
        if($this->product_item_slaves===null){
            
            $this->product_item_slaves=new ProductItemsItemCollection(null,$this->getSite());
        }
        return $this->product_item_slaves;
    }

    
    function toArrayForXML(){
        $item= parent::toArray();
        $item['tax']= $this->getTax()->get('rate');
        $item['linked_item']= $this->getLinkedItem()->get('reference');
        return $item ;
    }
    
    function getQuantity()
    {
        return floatval($this->get('quantity'));
    }
    
    
    
    function getMastersAndSlaves()
    {
        if ($this->master_and_slaves===null)
        {
            $this->master_and_slaves=new ProductItemCollection();
        }   
        return $this->master_and_slaves;
    }
    
    
    function getSlaves()
    {
        if ($this->_slaves===null)
        {
            $this->_slaves=new ProductItemCollection($this,$this->getSite());
        }   
        return $this->_slaves;
        
    }
    
    function getItemsNotInProductForSelect(){
        $collection=new mfArray(null, $this->getSite());
        if($this->isNotLoaded())
            return $collection;
        $db= mfSiteDatabase::getInstance();
        $db->setParameters(array('id'=> $this->get('id'),'product_id'=> $this->get('product_id')))
            ->setQuery(
                        "SELECT ".ProductItem::getFieldsAndKeyWithTable()." FROM ".ProductItem::getTable().                                  
                           " WHERE ".ProductItem::getTableField('id')."!='{id}' ".  
                           " AND ".ProductItem::getTableField('product_id')."!='{product_id}' ".  
                           ";"
                    )
            ->makeSiteSqlQuery($this->getSite());
        if (!$db->getNumRows())
            return $collection;        
        while ($item=$db->fetchObject('ProductItem'))
        {
           $collection[$item->get('id')]=$item->get('reference');
        }         
        return $collection;        
    }
    
    
     function getMasters(){
        
        return $this->masters=$this->masters===null?new ProductItemCollection($this,$this->getSite()):$this->masters;
    }
    
    function addSlaveForMaster($slave){
        $item=new $this();
        $item->add($slave)->set('product_id', $this->getProduct())->save();
        $items_item=new ProductItemsItem();
        $items_item->add(array(
            'item_master_id'=> $this,
            'item_slave_id'=>$item
        ))->save();
        return $this;
    }
    
       function toArrayForApi($options)
    {
        if ($this->formatter_api===null)
        {
            $this->formatter_api=new MasterProductFormatterApi($this,$options);
        }
        return $this->formatter_api;
    }
    
    function toArrayForApi2()
     {
        if ($this->formatter_api===null)
        {
            $this->formatter_api=new MasterProductFormatterApi($this,$options);
        }
        return $this->formatter_api;
     }
}
