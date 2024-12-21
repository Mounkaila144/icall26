<?php
 
class ProductItemFormFileImport  {
              
    protected $import_file=null,$site=null;
    
    function __construct(File $import_file,$site=null) {                  
        $this->import= new ProductItemFormImportModel($import_file->getFile(),0,true);        
        $this->site=$site;      
    }  
    
    function getLanguage()
    {
        return mfContext::getInstance()->getUser()->getLanguage();
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getImport()
    {
        return $this->import;
    }

    function execute() 
    {        
        try
        {          
            if ($this->getImport()->getName()!==false)
            {                                                                  
                $products =new ProductCollection(null,$this->getSite());  
                $product_items =new ProductItemCollection(null,$this->getSite()); 
                $idx=0;
                foreach ($this->getImport()->products->product as $item)
                {                          
                    $product =new Product(array('meta_title'=>$item->meta_title),$this->getSite());
                    $product->add((array)$item);
                    $tax=new Tax(array('rate'=>$item->tax),$this->getSite());
                    $product->set('tva_id',$tax);
                    $products[$idx++]=$product;                  
                }
                $products->loaded()->save(); 
                $idx=0;
                foreach ($this->getImport()->products->product as $item){
                    
                    foreach ($item->items->item as $product_item){                      
                        $productItem =new ProductItem();
                        $productItem->add((array)$product_item);
                        $tax=new Tax(array('rate'=>$product_item->tax),$this->getSite());
                        $productItem->set('tva_id',$tax);
                        $linked_id=new ProductItem(array('reference'=>$product_item->linked_item),$this->getSite());
                        $productItem->set('linked_id',$linked_id);
                        $productItem->set('product_id',$products->getItemByKey($idx)->get('id'));
                        $product_items[$productItem->get('reference')]=$productItem; 
                    }
                    $idx++;
                } 
                $product_items->loaded()->save();
                $product_items_item =new ProductItemsItemCollection($product_items,$this->getSite());   
             //   var_dump($product_items_item);
                $product_items_item->import($this->getImport()->links)->save();
            }   
            else 
            {                      
                throw new ImportException(ImportException::ERROR_IMPORT,array('errors'=>__('The Xml format is invalid.')));
            }    
        }
        catch (ImportException $e)
        {
            throw new mfException($e->getI18nMessage());
        } 
        catch (Exception $e)
        {
            throw new mfException($e->getMessage());
        } 
    }
           
}
