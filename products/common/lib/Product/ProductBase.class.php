<?php

class ProductBase extends mfObject2 {
     
    protected static $fields=array('tva_id','reference','price','purchasing_price','picture','meta_title',
                                   'meta_description' ,'content','is_active','status',
                                   'action_id','unit', 'position','engine',
                                   'prime_price','discount_price','standard_price','max_limit',
                                   'is_monthly','is_billable',  'is_consomable','url', 
                                   'item_description','item_content','item_details',
                                   'item_thickness','item_input2','item_input3',
                                   'item_input4','item_input5','item_input6',
                                   'item_input7','created_at','updated_at');
    const table="t_products"; 
    protected static $foreignKeys=array('tva_id'=>'Tax',
                                        'action_id'=>'ProductAction'); // By default
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['reference']) && isset($parameters['reference']))
             return $this->loadbyReference((string)$parameters['reference']); 
           if (isset($parameters['meta_title']) && isset($parameters['meta_title']))
             return $this->loadbyMetaTitle((string)$parameters['meta_title']); 
            
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
        
    protected function loadByMetaTitle($meta_title)
    {
         $this->set('meta_title',$meta_title);         
         $db=mfSiteDatabase::getInstance()->setParameters(array('meta_title'=>$meta_title));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE meta_title='{meta_title}';")
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
      $this->price=isset($this->price)?$this->price:0.0;
      $this->discount_price=isset($this->discount_price)?$this->discount_price:0.0;
      $this->standard_price=isset($this->standard_price)?$this->standard_price:0.0;
      $this->status=isset($this->status)?$this->status:"ACTIVE";
      $this->is_monthly=isset($this->is_monthly)?$this->is_monthly:"NO";
      $this->is_billable=isset($this->is_billable)?$this->is_billable:"YES";
      $this->is_consomable=isset($this->is_consomable)?$this->is_consomable:"NO";
      $this->action_id=isset($this->action_id)?$this->action_id:0;
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
      $db->setParameters(array('meta_title'=>str_replace("%","%%",$this->get('meta_title')),'id'=>$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE meta_title='{meta_title}' ".$key_condition)
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
    
    function hasAction()
    {
       return (boolean)$this->_action_id; 
    }
    
    function getAction()
    {
       if ($this->_action_id === null)
       {
          $this->_action_id=new ProductAction($this->get('action_id'),$this->getSite());          
       }   
       return $this->_action_id;
    } 
    
    function getFormattedPrice()
    {
        return format_number($this->get('price'),"#.00");
    }
    
     function getFormattedPrimePrice()
    {
        return format_number($this->get('prime_price'),"#.00");
    }
    
     function getFormattedDiscountPrice()
    {
        return format_number($this->get('discount_price'),"#.00");
    }
    
     function getFormattedStandardPrice()
    {
        return format_number($this->get('standard_price'),"#.00");
    }
    
     function getStandardPrice()
    {
        return $this->get('standard_price');
    }
    
     function getFormattedEuroPrimePrice()
    {
        return format_currency($this->get('prime_price'),"EUR");
    }
    
    function getFormattedPurchasingPrice()
    {
        return format_number($this->get('purchasing_price'),"#.00");
    }
    
     function getFormattedMaxLimit()
    {
        return format_number($this->get('max_limit'),"#.00");
    }
    
    function addItem(ProductItem $item)
    {
        if ($this->product_items===null)      
            $this->product_items=new ProductItemCollection(null,$this->getSite());
        if (isset($this->product_items[$item->get('id')]))
           return $this;
        $this->product_items[$item->get('id')]=$item;                                 
        return $this;
    }
      
    
    function getProductItems()
    {
        if ($this->product_items===null)
        {
            $this->product_items= new ProductItemCollection(null,$this->getSite());
              $db=mfSiteDatabase::getInstance()
                ->setParameters(array('product_id'=>$this->get('id')))
                ->setQuery("SELECT * FROM ".ProductItem::getTable().      
                           " WHERE product_id='{product_id}'".
                           " ORDER BY position ASC".
                          // " ORDER BY is_active,reference ASC".
                           ";")               
                ->makeSiteSqlQuery($this->getSite()); 
            if (!$db->getNumRows())
                return $this->product_items;            
            while ($item=$db->fetchObject('ProductItem'))
            {
               $this->product_items[$item->get('id')]=$item->loaded();
            }                        
        }    
        return $this->product_items;
    }
    
     function getProductItemsForSelect()
    {
        if ($this->product_items_select===null)
        {
            $this->product_items_select= new mfArray();
              $db=mfSiteDatabase::getInstance()
                ->setParameters(array('product_id'=>$this->get('id')))
                ->setQuery("SELECT * FROM ".ProductItem::getTable().      
                           " WHERE product_id='{product_id}'".
                           " ORDER BY reference ASC".
                           ";")               
                ->makeSiteSqlQuery($this->getSite()); 
            if (!$db->getNumRows())
                return $this->product_items_select;            
            while ($item=$db->fetchObject('ProductItem'))
            {
               $this->product_items_select[$item->get('id')]=strtoupper($item->get('reference'));
            }                        
        }    
        return $this->product_items_select;
    }
    
    function getSalePrice()
    {
        return floatval($this->get('price'));
    }
    
    function getSalePriceWithTax()
    {
        return $this->getSalePriceWithoutTax() * (1 + $this->getTax()->getRate());
    }
    
    function getSalePriceWithoutTax()
    {
        return floatval($this->get('price'));
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
    
    function getDiscountPriceWithoutTax()
    {
        return floatval($this->get('discount_price')) / (1 + $this->getTax()->getRate());
    }
    
    function getDiscountPriceWithTax()
    {
        return floatval($this->get('discount_price')) ;// * (1 + $this->getTax()->getRate());
    }
    
    function getStandardPriceWithoutTax()
    {
        return floatval($this->get('standard_price')) / (1 + $this->getTax()->getRate());
    }
    
    function getStandardPriceWithTax()
    {
        return floatval($this->get('standard_price')); //  * (1 + $this->getTax()->getRate());
    }
    
     function getMaxLimit()
    {
        return floatval($this->get('max_limit'));  
    }
    
    function toArrayForDocument()
    {
        return $this->toArray(array(
           'reference','price','purchasing_price','meta_title',
           'meta_description' ,'content','unit','discount_price'                         
        ));
    }
    
    function __toString()
    {
        return (string)$this->get('meta_title');
    }
    
    function isMonthly()
    {
        return $this->get('is_monthly')=='YES';
    }
    
    function isBillable()
    {
        return $this->get('is_billable')=='YES';
    }
    
    function isConsomable()
    {
        return $this->get('is_consomable')=='YES';
    }
    
    
    function toArray($fields = null) {
        $values=parent::toArray($fields);
        if (!in_array('prime_price',$fields))
            return $values;
        foreach (array('prime_price'=>'getFormattedPrimePrice',
                       'discount_price'=>'getFormattedDiscountPrice',
                       'standard_price'=>'getFormattedStandardPrice',            
                       'prime_price_euro'=>'getFormattedEuroPrimePrice') as $field=>$method)
        {
            $values[$field]=$this->$method();
        }                    
        return $values;
    }
    
    function getMetaTitle()
    {
        return new mfString($this->get('meta_title'));
    }
    
    function toArrayForXML(){
        $item= parent::toArray();
        $item['tax']= $this->getTax()->get('rate');
        return $item;
    }
    
    function copyAndSave(){       
        
        $copy= parent::copy();
        $copy->set('meta_title',$copy->getMetaTitle().'-{id}')
             ->save()
             ->set('meta_title', str_replace('{id}', $copy->get('id'), $copy->getMetaTitle()))
             ->save(); 
        return $copy;
    }
    

    function isNotUsed(){
            $db= mfSiteDatabase::getInstance()
            ->setParameters(array('product_id'=> $this->get('id')))
            ->setQuery("SELECT ".Product::getTableField('id')." FROM ".Product::getTable().
                       " LEFT JOIN ".DomoprimeQuotationProduct::getInnerForJoin('product_id').
                       " LEFT JOIN ".DomoprimeBillingProduct::getInnerForJoin('product_id').
                       " WHERE ".Product::getTableField('id')."='{product_id}'".
                       " AND ".DomoprimeQuotationProduct::getTableField('product_id')." IS NULL".
                       " AND ".DomoprimeBillingProduct::getTableField('product_id')." IS NULL".
                   ";" )
            ->makeSiteSqlQuery($this->site);
            $row=$db->fetchRow();
        return (boolean)$row[0];        
            
    }

      function updatePositions(mfArray $positions)
    {            
         if ($positions->isEmpty())
            return ;
         $db=mfSiteDatabase::getInstance();
         foreach ($positions as $position=>$id)
         {    
                $db->setParameters(array('position'=>$position+1,'id'=>$id,'product_id'=>$this->get('id')))
                   ->setQuery("UPDATE ".ProductItem::getTable()." SET position={position} ".
                              " WHERE id={id} AND product_id ='{product_id}'".                       
                              ";")               
                ->makeSqlQuery(); 
         }                
         // Renumbering the rest if exists
         $db->setQuery("SELECT @position:=".$positions->count().";")
              ->makeSqlQuery();        
         $db->setParameters(array('item_master_id'=>$this->get('id')))
            ->setQuery("UPDATE ".ProductItem::getTable()." SET position=( SELECT @position:=@position+1 ) ".
                      " WHERE id NOT IN('".$positions->implode("','")."') AND product_id ='{product_id}'".
                      " ORDER BY position".
                      ";")
           ->makeSqlQuery();          
        return $this;
    }
    
    
    /*
       SELECT t_products_items_item.id,t_products_items_item.item_master_id FROM t_products_items_item
       INNER JOIN t_products_item ON t_products_item.id = t_products_items_item.item_master_id
       WHERE t_products_item.
     * 
     * 
     */

    function getMasterItems()
    {
         if ($this->master_items===null)
       {
           $this->master_items = new ProductItemsItemCollection(null,$this->getSite());
           if ($this->isNotLoaded())
               return $this->master_items;
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('product_id'=>$this->get('id')))  
                ->setObjects(array('ProductItemsItem','ProductItem'))
                ->setQuery("SELECT {fields} FROM ".ProductItemsItem::getTable().      
                           " INNER JOIN ".ProductItemsItem::getOuterForJoin('item_master_id').
                           " WHERE ".ProductItem::getTableField('product_id')."='{product_id}'". 
                           " GROUP BY ".ProductItem::getTableField('id').
                           " ORDER BY ".ProductItem::getTableField('position')." ASC ".                           
                           ";")
                ->makeSiteSqlQuery($this->getSite());
        // echo $db->getQuery();
         if (!$db->getNumRows())
            return $this->master_items;     
          while ($items=$db->fetchObjects())
        {
           $item=$items->getProductItemsItem();
           $item->set('item_master_id',$items->getProductItem());
           $this->master_items[$item->get('id')]=$item; //$item->loaded()->setSite($this->getSite());
        }     
       }   
       return $this->master_items;
    }
    
    
    function getSlaveItems()
    {
         if ($this->slave_items===null)
       {
           $this->slave_items = new ProductItemsItemCollection(null,$this->getSite());
           if ($this->isNotLoaded())
               return $this->slave_items;
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('product_id'=>$this->get('id')))  
                ->setObjects(array('ProductItemsItem','ProductItem'))
                ->setQuery("SELECT {fields} FROM ".ProductItemsItem::getTable().      
                           " INNER JOIN ".ProductItemsItem::getOuterForJoin('item_slave_id').                        
                           " WHERE ".ProductItem::getTableField('product_id')."='{product_id}'". 
                           " GROUP BY ".ProductItem::getTableField('id').
                           " ORDER BY ".ProductItem::getTableField('position')." ASC ".                           
                           ";")
                ->makeSiteSqlQuery($this->getSite());         
         if (!$db->getNumRows())
                   return $this->slave_items;     
          while ($items=$db->fetchObjects())
        {
           $item=$items->getProductItemsItem();
           $item->set('item_slave_id',$items->getProductItem());
           $this->slave_items[$item->get('id')]=$item; //$item->loaded()->setSite($this->getSite());
        }     
       }   
       return $this->slave_items; 
    }
    
    
    function getMasterWithSlaveItems()
    {
          if ($this->master_slave_items===null)
       {
           $this->master_slave_items = new ProductItemCollection(null,$this->getSite());
           if ($this->isNotLoaded())
               return $this->master_slave_items;
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('product_id'=>$this->get('id')))  
               // ->setObjects(array('ProductItemsItem','ProductItem'))
                ->setObjects(array('ProductItem'))
                ->setQuery("SELECT {fields} FROM ".ProductItemsItem::getTable().      
                           " INNER JOIN ".ProductItemsItem::getOuterForJoin('item_master_id').
                           " WHERE ".ProductItem::getTableField('product_id')."='{product_id}'". 
                           " GROUP BY ".ProductItem::getTableField('id').
                           " ORDER BY ".ProductItem::getTableField('position')." ASC ".                           
                           ";")
                ->makeSiteSqlQuery($this->getSite());
       // echo $db->getQuery();            
         if (!$db->getNumRows())
                   return $this->master_slave_items;     
          while ($items=$db->fetchObjects())
        {
            $item=$items->getProductItem();       
            $this->master_slave_items[$item->get('id')]=$item; 
        }     
       }   
       return $this->master_slave_items; 
    }
    
    
    
   /* function getMasterItems()
    {
         if ($this->master_items===null)
       {
           $this->master_items = new ProductItemsItemCollection(null,$this->getSite());
           if ($this->isNotLoaded())
               return $this->master_items;
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('product_id'=>$this->get('id')))  
                ->setObjects(array('ProductItem'))
                ->setQuery("SELECT {fields} FROM ".ProductItemsItem::getTable().      
                           " INNER JOIN ".ProductItemsItem::getOuterForJoin('item_master_id').
                           " WHERE ".ProductItem::getTableField('product_id')."='{product_id}'". 
                           " GROUP BY ".ProductItem::getTableField('id').
                           " ORDER BY ".ProductItem::getTableField('position')." ASC ".                           
                           ";")
                ->makeSiteSqlQuery($this->getSite());
         if (!$db->getNumRows())
                   return $this->master_items;     
          while ($items=$db->fetchObjects())
        {
           $item=$items->getProductItem();    
           $item->set('product_id',$this);
           $this->master_items[$item->get('id')]=$item; 
        }     
       }   
       return $this->master_items;
    } */


    function getRestProductsForContract(){
                // Get rest contracts without products
        
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('product_id'=>$this->get('id')))                
            ->setQuery("SELECT COUNT(".CustomerContract::getTableField('id').") FROM ".CustomerContract::getTable(). 
                       " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id')." AND ".CustomerContractProduct::getTableField('product_id')."='{product_id}'".  
                       " WHERE  ".CustomerContractProduct::getTableField('id')." IS NULL".
                                " AND is_hold='NO'".
                       ";")               
            ->makeSiteSqlQuery($this->getSite());
        $row=$db->fetchRow();
        $this->rest_products_for_contracts=$row[0] ;
        
        return $this->rest_products_for_contracts;
    }
    
    function getRestProductsForMeeting(){
        // Get rest meetings without products
        
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('product_id'=>$this->get('id')))                
            ->setQuery("SELECT COUNT(".CustomerMeeting::getTableField('id').") FROM ".CustomerMeeting::getTable(). 
                       " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('meeting_id')." AND ".CustomerMeetingProduct::getTableField('product_id')."='{product_id}'".  
                       " WHERE  ".CustomerMeetingProduct::getTableField('id')." IS NULL".
                                " AND is_hold='NO'".
                       ";")               
            ->makeSiteSqlQuery($this->getSite());
        $row=$db->fetchRow();
        $this->rest_products_for_meetings=$row[0] ;
        
        return $this->rest_products_for_meetings;
    }
    function getAllProductsForContract(){
                // Get rest contracts without products
        
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('product_id'=>$this->get('id')))                
            ->setQuery("SELECT COUNT(".CustomerContract::getTableField('id').") FROM ".CustomerContract::getTable(). 
                       " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id')." AND ".CustomerContractProduct::getTableField('product_id')."='{product_id}'".  
                       " WHERE is_hold='NO'".
                       ";")               
            ->makeSiteSqlQuery($this->getSite());
        $row=$db->fetchRow();
        $this->all_products_for_contracts=$row[0] ;
        
        return $this->all_products_for_contracts;
    }
    
    function getAllProductsForMeeting(){
        // Get rest meetings without products
        
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('product_id'=>$this->get('id')))                
            ->setQuery("SELECT COUNT(".CustomerMeeting::getTableField('id').") FROM ".CustomerMeeting::getTable(). 
                       " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('meeting_id')." AND ".CustomerMeetingProduct::getTableField('product_id')."='{product_id}'".  
                       " WHERE  is_hold='NO'".
                       ";")               
            ->makeSiteSqlQuery($this->getSite());
        $row=$db->fetchRow();
        $this->all_products_for_meetings=$row[0] ;
        
        return $this->all_products_for_meetings;
    }
    
    

    
    function getContractAndMeetingProductsRestCount(){
        
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('product_id'=>$this->get('id')))                
            ->setQuery( "SELECT COUNT(".CustomerContract::getTableField('id').") FROM ".CustomerContract::getTable(). 
                       " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id')." AND ".CustomerContractProduct::getTableField('product_id')."='{product_id}'".  
                       " WHERE  ".CustomerContractProduct::getTableField('id')." IS NULL".
                                " AND is_hold='NO'".
                        "UNION SELECT COUNT(".CustomerMeeting::getTableField('id').") FROM ".CustomerMeeting::getTable(). 
                        " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('meeting_id')." AND ".CustomerMeetingProduct::getTableField('product_id')."='{product_id}'".  
                        " WHERE  ".CustomerMeetingProduct::getTableField('id')." IS NULL".
                                " AND is_hold='NO'".
                       ";")               
            ->makeSiteSqlQuery($this->getSite());
        while ($row=$db->fetchRow()){
            $sum+=$row[0];                       
        }
        $this->contract_and_meeting_products_rest_count=$sum ;
        return $this->contract_and_meeting_products_rest_count;
    }
          
    
    function save()
     {
         parent::save();
         mfCacheFile::removeCache('products','admin',$this->getSite());         
         return $this;
     }
     
      function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('products','admin',$this->getSite());         
         return $this;
     }
     
     
    function  hasItemDescription()
    {
       return (boolean)$this->get('item_description');      
    }
    function  hasItemContent()
    {
       return (boolean)$this->get('item_content');      
    }
    function  hasItemDetails()
    {
       return (boolean)$this->get('item_details');      
    }
    
    function getItems()
    {                       
      return $this->_items = $this->_items===null?new ProductItemCollection($this,$this->getSite()):$this->_items;
    }
    
    
     function updateItems($items){
        
        $items_keys=array();      
        foreach ($items as $index=>$item)
        {
            if (isset($item['id']))
               $items_keys[$index]= $item['id'];
        }          
        if (empty($items_keys))
        {
           $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('product_id'=>$this->get('id')))              
                ->setQuery("DELETE FROM ". ProductItem::getTable().                       
                           " WHERE product_id='{product_id}' ".
                           ";")
                ->makeSiteSqlQuery($this->site);   
           return $this;
        }
        // Delete items not used               
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('product_id'=>$this->get('product_id')))              
            ->setQuery("DELETE FROM ". ProductItem::getTable().                       
                       " WHERE product_id='{product_id}' AND ". ProductItem::getTableField('id')." NOT IN('".implode("','",$items_keys)."')".
                       ";")
            ->makeSiteSqlQuery($this->site); 
        
        $modified_items=new ProductItemCollection(null, $this->getSite());               
            // Load existing items used and update them
        $db=mfSiteDatabase::getInstance()           
        ->setParameters(array('product_id'=>$this->get('id')))  
        ->setObjects(array('ProductItem','Product'))
        ->setQuery("SELECT {fields} FROM ". ProductItem::getTable(). 
                   " INNER JOIN ".ProductItem::getOuterForJoin('product_id').
                   " WHERE product_id='{product_id}' AND ".ProductItem::getTableField('id')." IN('".implode("','",$items_keys)."')".
                   ";")
        ->makeSiteSqlQuery($this->site); 
       if ($db->getNumRows())
       {        
            while ($ProductItems=$db->fetchObjects())
            {
                 $key=array_search($ProductItems->getProductItem()->get('id'),$items_keys);               
                 $ProductItems->getProductItem()->set('product_id',$this);  
                 $modified_items[$key]=$ProductItems->getProductItem();                                 
            }       

             $modified_items->loaded();
            // Update items     
            foreach ($modified_items as $index=>$item)
            {
                $item->add($items[$index]);                       
                unset($items[$index]); // Remove updated items
            }
       }
    
        // Insert new items
        foreach ($items as $index=>$item)
        {
            $ProductItem=new ProductItem(null,$this->getSite());
            $ProductItem->add($items[$index]);
            $ProductItem->set('product_id', $this->get('id'));
            $modified_items[]=$ProductItem; 
        }
        $modified_items->save();
        
        
        $slaves= new mfArray();
        foreach($modified_items as $item){
            if($modified_items[0]!=$item)
                $slaves[$item->get('id')]=$item;
        }
        $modified_items[0]->updateItems($slaves);


        return $this;
    }
    
     static function getAll($site=null)
    {
        $values=new ProductCollection(null,$site);
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable(). 
                           " WHERE is_active='YES' AND status='ACTIVE'".
                           " ORDER BY reference ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('Product'))
        { 
            $values[$item->get('id')]=$item->loaded()->setSite($site);
        }      
        return $values;
    }
}
