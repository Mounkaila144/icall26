<?php


class ProductItemUtilsBase {
    
    
        static function copyItemsFrom(Product $copy,Product $source){
                $productIems=new ProductItemCollection(null,$source->getSite());
                $db= mfSiteDatabase::getInstance();
                $db->setParameters(array("product_id"=>$source->get('id')))
                    ->setQuery("SELECT * FROM ". ProductItem::getTable().
                                " WHERE product_id='{product_id}';"
                            )
                    ->makeSiteSqlQuery($source->getSite());
                if (!$db->getNumRows())
                return $productIems;
                while ($item=$db->fetchObject('ProductItem')){            
                    $copyItem=new ProductItem(null, $source->getSite());
                    $copyItem->copyFrom($item);
                    $copyItem->set('product_id', $copy);
                    $productIems[$item->get('id')]=$copyItem;

                } 
                return $productIems->save();
                
                return $productIems;

        }
    
    
        static function copyLinksFrom(ProductItemCollection $products_item,Product $source){

             $product_items_item =new ProductItemsItemCollection(null,$source->getSite()); 
             $db= mfSiteDatabase::getInstance();
             $db->setParameters(array("product_id"=>$source->get('id')))
              ->setObjects(array('ProductItemsItem','slave'=>'ProductItem','master'=>'ProductItem'))        
              ->setAlias(array('master'=>'master','slave'=>'slave'))   
                 ->setQuery(
                             "SELECT {fields} FROM ". ProductItemsItem::getTable().
                             " INNER JOIN ".ProductItem::getTable()." as master ON master.id=".ProductItemsItem::getTableField('item_master_id').
                             " INNER JOIN ".ProductItem::getTable()." as slave ON slave.id=".ProductItemsItem::getTableField('item_slave_id').
                             " WHERE master.product_id='{product_id}' OR slave.product_id='{product_id}'".
                             ";"
                         )
                 ->makeSiteSqlQuery($source->getSite());
             if (!$db->getNumRows())
                 return $product_items_item;

             while ($items=$db->fetchObjects()){            
                 $copyItem=new ProductItemsItem(null, $source->getSite());
                 $copyItem->copyFrom($items->getProductItemsItem());
                 $copyItem->set('item_master_id', $products_item->getItemById($items->getMaster()->get('id')));
                 $copyItem->set('item_slave_id', $products_item->getItemById($items->getSlave()->get('id')));
                 $product_items_item[]=$copyItem;

             } 
             $product_items_item->save();
             return $product_items_item;

     }
    
    
    
        
    static function copyItemsWithLinksFrom(ProductItem $source){
                
        // copy item
        $copy= new ProductItem(null, $source->getSite());
        $copy->copyFrom($source)
             ->set('product_id', $source->get('product_id'))
             ->save();
                
        $product_items_item =new ProductItemsItemCollection(null,$source->getSite());
        // copy masters
        $db= mfSiteDatabase::getInstance();
            $db->setParameters(array("product_id"=>$source->get('id')))
                ->setQuery(
                            "SELECT * FROM ". ProductItemsItem::getTable().
                            " WHERE item_master_id='{product_id}'".
                            ";"
                        )
                ->makeSiteSqlQuery($source->getSite());
            if ($db->getNumRows())
            {
                while ($item=$db->fetchObject('ProductItemsItem')){            
                    $copyItem=new ProductItemsItem(null, $source->getSite());
                    $copyItem->copyFrom($item);
                    $copyItem->set('item_master_id', $copy->get('id'));
                    $copyItem->set('item_slave_id', $item->get('item_slave_id'));
                    $product_items_item[]=$copyItem;

                } 
            }
            // copy salves
            $db= mfSiteDatabase::getInstance();
            $db->setParameters(array("product_id"=>$source->get('id')))
                ->setQuery(
                            "SELECT * FROM ". ProductItemsItem::getTable().
                            " WHERE item_slave_id='{product_id}'".
                            ";"
                        )
                ->makeSiteSqlQuery($source->getSite());
            if ($db->getNumRows()){
                while ($item=$db->fetchObject('ProductItemsItem')){            
                    $copyItem=new ProductItemsItem(null, $source->getSite());
                    $copyItem->copyFrom($item);
                    $copyItem->set('item_master_id', $item->get('item_master_id'));
                    $copyItem->set('item_slave_id',$copy->get('id') );
                    $product_items_item[]=$copyItem;

            }
            }
            
            $product_items_item->save();
        

    }
    
    
      function getItemsBySelection(mfArray $ids,$site=null){
        
        $collection=new ProductItemCollection(null,$site);
        if(empty($ids))
            return $collection;
        $product_items =new ProductItemCollection(null,$site); 
        $db= mfSiteDatabase::getInstance();
        $db->setParameters(array())
            ->setQuery(
                        "SELECT ".ProductItem::getFieldsAndKeyWithTable()." FROM ".ProductItem::getTable().                                  
                           " WHERE ".ProductItem::getTableField('id')." IN('".$ids->implode("','")."') ".  
                           ";"
                    )
            ->makeSiteSqlQuery($site);
        if (!$db->getNumRows())
            return $collection;        
        while ($item=$db->fetchObject('ProductItem'))
        {
           $collection[$item->get('id')]=$item->loaded()->setSite($site);
        }         
        return $collection;        
    }
}
