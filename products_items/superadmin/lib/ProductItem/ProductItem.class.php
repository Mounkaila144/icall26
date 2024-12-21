<?php



class ProductItem extends  ProductItemBase {
     
    
    static function initializeSite($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("DELETE FROM ".ProductItem::getTable().";")               
                ->makeSiteSqlQuery($site);  
          $db->setQuery("ALTER TABLE ".ProductItem::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
          
        
    }
}
