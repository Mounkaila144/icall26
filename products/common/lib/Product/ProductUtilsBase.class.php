<?php

class ProductUtilsBase {
  
    static function getProductsForSelect($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".Product::getTable().      
                           " ORDER BY meta_title ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $list=array();
        while ($item=$db->fetchObject('Product'))
        {
           $list[$item->get('id')]=strtoupper($item->get('meta_title'));
        }            
        return $list;
    }   
    
    static function getActiveProductsForSelect($site=null)
    {
        static $products=null;
        
        if ($products===null)
        {    
            $products=array();
            $db=mfSiteDatabase::getInstance()
                    ->setParameters(array())
                    ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".Product::getTable().  
                               " WHERE ".Product::getTableField('status')."='ACTIVE' ".
                                    " AND ".Product::getTableField('is_active')."='YES'".
                               ";")               
                    ->makeSiteSqlQuery($site); 
            if (!$db->getNumRows())
                return $products;        
            while ($item=$db->fetchObject('Product'))
            {
               $products[$item->get('id')]=strtoupper($item->get('meta_title'));
            }
        }
        return $products;
    }   
    
    static function getProductsActiveForSelect($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".Product::getTable().
                           " WHERE status='ACTIVE' AND is_active='YES'".
                           " ORDER BY meta_title COLLATE utf8_general_ci".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $list=array();
        while ($item=$db->fetchObject('Product'))
        {
           $list[$item->get('id')]=strtoupper($item->get('meta_title'));
        }            
        return $list;
    }   
    
    
     static function getUnknownProducts($products,$site=null)
    {
        $values=new mfArray();
        foreach ($products as $product)
           $values[]=  mfSiteDatabase::getInstance()->escape($product); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT meta_title FROM ".Product::getTable().
                           " WHERE UPPER(meta_title) IN('".$values->implode("','")."')".                          
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $products;        
        while ($row=$db->fetchArray())
        {
            if (($key=array_search($row['meta_title'],$products))!==false)
               unset($products[$key]);     
        }            
        return $products;
    }   
    
    static function getProducts($products,$site=null)
    {
        $values=new mfArray();
        foreach ($products as $product)
           $values[]=  mfSiteDatabase::getInstance()->escape($product); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".Product::getTable().
                           " WHERE UPPER(meta_title) IN('".$values->implode("','")."')".                         
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();        
        $items=array();
        while ($item=$db->fetchObject('Product'))
        {
           $items[]=$item->loaded()->setSite($site);
        }            
        return $items;
    }   
    
    static function getProductsByIds(mfArray $products,$site=null)
    {       
        $items=new ProductCollection(null,$site);
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".Product::getTable().
                           " WHERE id IN('".$products->implode("','")."')".                         
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $items;                
        while ($item=$db->fetchObject('Product'))
        {
           $items[$item->get('id')]=$item->loaded()->setSite($site);
        }            
        return $items;
    }   
    
     static function getProductActiveListForSelect($site=null)
    {
         $list=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".Product::getTable().
                           " WHERE status='ACTIVE' AND is_active='YES'".
                           " ORDER BY meta_title COLLATE utf8_general_ci".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $list;       
        while ($item=$db->fetchObject('Product'))
        {
           $list[$item->get('id')]=(string)$item;
        }            
        return $list;
    }   
    
    static function initializeSite($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("DELETE FROM ".Product::getTable().";")               
                ->makeSiteSqlQuery($site);  
          $db->setQuery("ALTER TABLE ".Product::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
                
          
          $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("DELETE FROM ".ProductAction::getTable().";")               
                ->makeSiteSqlQuery($site);  
          $db->setQuery("ALTER TABLE ".ProductAction::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site);                   
    }
    
    static function getProductsAndItemsByPosition($site=null)
    {
        $list=new ProductCollection(null,$site);
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('Product','ProductItem'))
                ->setQuery("SELECT {fields} FROM ".Product::getTable().
                           " INNER JOIN ".ProductItem::getInnerForJoin('product_id').
                           " WHERE ".Product::getTableField('status')."='ACTIVE' AND ".Product::getTableField('is_active')."='YES'".
                           //" ORDER BY meta_title COLLATE utf8_general_ci".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $list;        
        while ($items=$db->fetchObjects())
           $item=$items->getProduct();
        {
           if (!isset($list[$item->get('id')]))
                $list[$item->get('id')]=$item;
           $list[$item->get('id')]->addItem($items->getProductItem());
        }            
        return $list;
    } 
    
    
     static function getActiveProducts($site=null)
    {
        $list=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".Product::getTable().
                           " WHERE status='ACTIVE' AND is_active='YES'".
                           " ORDER BY meta_title COLLATE utf8_general_ci".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $list;       
        while ($item=$db->fetchObject('Product'))
        {
           $list[$item->get('id')]=$item;
        }            
        return $list;
    }   
    
    
    static function updateEngines(mfArray $engines,$site=null)
    {       
        $product_ids=new mfArray();
        foreach ($engines as $engine)       
           $product_ids[]=$engine['product_id'];        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".Product::getTable().
                           " WHERE id IN('".$product_ids->implode("','")."')".                        
                           ";")               
                ->makeSiteSqlQuery($site);        
        if (!$db->getNumRows())
            return ;  
        $list=new ProductCollection(null,$site);
         while ($item=$db->fetchObject('Product'))
        {            
            $list[$item->get('id')]=$item->loaded()->setSite($site);
        }    
        $list->loaded();
        foreach ($engines as $engine)
        {
            if (!isset($list[$engine['product_id']]))
                continue;
            $list[$engine['product_id']]->set('engine',$engine['engine']);
        }    
        $list->save();       
    }
    
    
    static function getProductsAndItemsByPositionFromSelection(mfArray $selection,$site=null)
    {                    
        $list=new ProductCollection(null,$site);
        if ($selection->isEmpty())
            return $list;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('Product','ProductItem'))
                ->setQuery("SELECT {fields} FROM ".Product::getTable().
                           " INNER JOIN ".ProductItem::getInnerForJoin('product_id').
                           " WHERE ".Product::getTableField('status')."='ACTIVE' AND ".Product::getTableField('is_active')."='YES'".
                                " AND ".Product::getTableField('id')." IN('".$selection->implode("','")."')".
                           //" ORDER BY meta_title COLLATE utf8_general_ci".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $list;        
        while ($items=$db->fetchObjects())
        {
           $item=$items->getProduct();
           if (!isset($list[$item->get('id')]))
                $list[$item->get('id')]=$item;
           $list[$item->get('id')]->addItem($items->getProductItem());
        }            
        return $list;
    } 
    
    static function getProductsAndItemsWithMasterByPositionFromSelection(mfArray $selection,$site=null)
    {                    
        $list=new ProductCollection(null,$site);
        if ($selection->isEmpty())
            return $list;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('Product','ProductItem'))
                ->setQuery("SELECT {fields},item_master_id as `ProductItem.is_master` FROM ".Product::getTable().
                           " INNER JOIN ".ProductItem::getInnerForJoin('product_id').
                           " LEFT JOIN ".ProductItemsItem::getInnerForJoin('item_master_id').
                           " WHERE ".Product::getTableField('status')."='ACTIVE' AND ".Product::getTableField('is_active')."='YES'".
                                " AND ".Product::getTableField('id')." IN('".$selection->implode("','")."')".                         
                           " GROUP BY ".ProductItem::getTableField('id').
                           " ORDER BY ".ProductItem::getTableField('is_active').",CONCAT(".Product::getTableField('reference').",".ProductItem::getTableField('reference').") COLLATE utf8_general_ci ASC ".  
                           ";")               
                ->makeSiteSqlQuery($site); 
        
        if (!$db->getNumRows())
            return $list;        
        while ($items=$db->fetchObjects())
        {          
           $item=$items->getProduct();
           if (!isset($list[$item->get('id')]))
                $list[$item->get('id')]=$item;           
           $list[$item->get('id')]->addItem($items->getProductItem());
        }            
        return $list;
    } 
    
     static function getProductsAndItemsWithMaster( )
    {                    
        $list=new ProductCollection();
       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('Product','ProductItem'))
                ->setQuery("SELECT {fields} FROM ".Product::getTable().
                           " INNER JOIN ".ProductItem::getInnerForJoin('product_id').
                           " LEFT JOIN ".ProductItemsItem::getInnerForJoin('item_master_id').
                      
                           ";")               
                ->makeSiteSqlQuery($site); 
        
        echo $db->getQuery();die();
        if (!$db->getNumRows())
            return $list;        
        while ($items=$db->fetchObjects())
        {          
           $item=$items->getProduct();
           if (!isset($list[$item->get('id')]))
                $list[$item->get('id')]=$item;           
           $list[$item->get('id')]->addItem($items->getProductItem());
        }            
        return $list;
    } 
}

