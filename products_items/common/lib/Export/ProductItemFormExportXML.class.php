<?php
 
class ProductItemFormExportXML {
    
    const UPPERCASE=1,TRIM=2;
    
    protected $formt=null,$options=array(),$site=null,$parameters=null,
              $filename="",$handler=null,$path="",$name="",$query=null,$filter=null;
    
    function __construct($pager,$options=array(),$site=null) 
    {
        $this->pager=$pager;
        $this->query= new mfQuery();           
        $this->site=$site;
        $this->options=array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'UTF-8','separator'=>';'));    
        $this->configure();
        $this->filename=$this->getDirectory()."/".$this->getName();
    }
    
    function configure()
    {       
        $this->path="/data/exports/forms";
        $this->name="export-products-items-".date("Y-m-d_H_i_s").".xml";       
    }
       
    function getOption($name,$default=null)
    {
        return array_key_exists($name, $this->options)?$this->options[$name]:$default;
    } 
    
    function setOption($name,$value)
    {
        $this->options[$name]=$value;
        return $this;
    } 
    
    function getOptions()
    {
        return $this->options;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function isDebug()
    {
        return $this->getOption('debug',false);
    }
    
    function debug()
    {
        $this->setOption('debug',true);
        return $this;
    }
    
    function getPager(){
        return $this->pager;
    }
    
    
    function getHeader()
    {
        return $this->header;
    }
    
    protected function escape($value="")
    {
        return str_replace('"', '', $value);
    }
    
    protected function formatField($name)
    {
        return '"'.$this->escape($this->encode($name)).'"';
    }
    
    protected function encode($str)
    {     
        return mb_convert_encoding($str ,$this->getOption('charset_to','UTF-8'),$this->getOption('charset_from','UTF-8'));       
    }   
     
    
    function process()
    {   
        // Process column schema for header 
        $this->execute();
    }
  
    function getQuery()
    {
        return $this->query;
    }
         
    function execute()
    {                            
        $ids=array_keys($this->getPager()->getItems());
        $this->query->select("{fields}")
             ->from(ProductItem::getTable(),'ProductItemMaster')
             ->inner(Product::getTable()." ON ".Product::getTableField('id')."=ProductItemMaster.product_id")
             ->left(ProductItem::getTable()." AS ProductItemEsclave ON ProductItemEsclave.id=ProductItemMaster.linked_id")    
             ->left(Tax::getTable()." ON ".Tax::getTableField('id')."= ".Product::getTableField('tva_id'))  
             ->where(" ProductItemMaster.id IN('".implode("','",$ids)."') OR ProductItemEsclave.id IN('".implode("','",$ids)."')");   
        
       // echo (string)$this->getQuery();
      
        $db=new mfSiteDatabase();
        $db->setParameters(array())
             ->setObjects(array('ProductItemMaster'=>'ProductItem','ProductItemEsclave'=>'ProductItem','Product','Tax'))        
             ->setAlias(array('ProductItemMaster'=>'ProductItemMaster','ProductItemEsclave'=>'ProductItemEsclave'))        
             ->setQuery((string)$this->getQuery())               
             ->makeSiteSqlQuery($this->getSite());  

        $this->open();
        
        $this->getItemsFromDatabase($db);   
        
        //masters & slaves
        $this->query= new mfQuery();  
        $this->query->select("{fields}")
             ->from(ProductItemsItem::getTable())
             ->inner(ProductItem::getTable()." as Master ON Master.id=".ProductItemsItem::getTableField('item_master_id'))
             ->inner(ProductItem::getTable()." as Slave ON Slave.id=".ProductItemsItem::getTableField('item_slave_id'))
             ->where(ProductItemsItem::getTableField('item_master_id')." IN('".implode("','",$ids)."') OR ".ProductItemsItem::getTableField('item_slave_id')." IN('".implode("','",$ids)."')"  );
        
        $db=new mfSiteDatabase();
        $db->setParameters(array())
             ->setObjects(array('ProductItemsItem','Slave'=>'ProductItem','Master'=>'ProductItem'))        
             ->setAlias(array('Master'=>'Master','Slave'=>'Slave'))        
             ->setQuery((string)$this->getQuery())               
             ->makeSiteSqlQuery($this->getSite()); 
        
        $this->getMasterSlaveFromDatabase($db);
       /* var_dump($this->getMasterSlaveFromDatabase($db));
          die(__METHOD__);*/
        $this->close();

    }
        
    
    
    protected function getItemsFromDatabase($db)
    {
        if (!$db->getNumRows())           
            return $this; 
        $this->outputElement("<?xml version='1.0' encoding='UTF-8'?>\n");  
        $this->outputElement("<data>\n<products>\n");
        $products=new ProductCollection();
        while ($items = $db->fetchObjects() ) {
            if(!isset($products[$items->getProduct()->get('id')]))            
                $products[$items->getProduct()->get('id')]=$items->getProduct();
            if($items->hasTax())
                $products[$items->getProduct()->get('id')]->tva_id=$items->getTax();
            if($items->hasProductItemEsclave())
                $items->getProductItemMaster()->set('linked_id',$items->getProductItemEsclave());
            $products[$items->getProduct()->get('id')]->addItem($items->getProductItemMaster());                          
        }                  
        foreach ($products as $product){
            $this->outputElement("<product>\n"); 
            foreach($product->toArrayForXML() as $key=>$value){
                
                //if($key=="meta_description"){
                    $this->outputElement("<".$key."><![CDATA[".$value."]]></".$key.">\n");
              /*  }else{
                    $this->outputElement("<".$key.">".$value."</".$key.">\n");
                }*/
               
            }
            $this->outputElement("<items>\n"); 
            foreach($product->getProductItems() as $item){
                $this->outputElement("<item>\n"); 
                foreach($item->toArrayForXML() as $name=>$field){
                  //  if($name=="description" || $name=="mark" || $name=="reference"){
                        $this->outputElement("<".$name."><![CDATA[".$field."]]></".$name.">\n");                    
                 /*   }else{
                       $this->outputElement("<".$name.">".$field."</".$name.">\n"); 
                    }*/
                    
                }
                 $this->outputElement("</item>\n"); 
               
            }
            
            $this->outputElement("</items>\n"); 
            $this->outputElement("</product>\n"); 
        }        
        $this->outputElement("</products>\n");
    } 
    
    protected function getMasterSlaveFromDatabase($db)
    {
        if (!$db->getNumRows()){
            $this->outputElement("</data>\n");
             return $this; 
        }           
           
        $this->outputElement("<links>\n");
        $links=new ProductItemsItemCollection();
        while ($items = $db->fetchObjects() ) { 
            $item=$items->getProductItemsItem();
            $item->set('item_master_id',$items->getMaster())
                 ->set('item_slave_id',$items->getSlave());
            $links[]=$item;                          
        }  
        foreach ($links as $link){
            $this->outputElement("<link>\n"); 
            foreach($link->toArrayForXML() as $key=>$value){

                     $this->outputElement("<".$key."><![CDATA[".$value."]]></".$key.">\n");
               
            }
            $this->outputElement("</link>\n"); 
        }        
        $this->outputElement("</links>\n</data>\n");
    }
    
    function getFilename()
    {        
        return $this->filename;
    }
    
    function open()
    {              
        mfFileSystem::mkdirs(dirname($this->getFilename()));
        $this->handler=fopen($this->getFilename(),"w+");
    }
    
    function close()
    {
        if ($this->handler)
           fclose ($this->handler);
        return $this;
    }
    
    function getName()
    {
        return $this->name;
    }
    
    function getDirectory()
    {       
        if ($this->getSite())
        {    
            $site_name=($this->getSite() instanceof Site)?$this->getSite()->get('site_host'):mfConfig::get('mf_site_host');
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name.$this->getPath(); 
        }
        return mfConfig::get('mf_site_app_cache_dir').$this->getPath();        
    }
    
    function getPath()
    {
        return $this->path;
    }
    
    function outputElement($data_xml)
    {            
        $this->writeElement($data_xml."\n");
    }
    
    protected function writeElement($element)
    {
        if ($this->isDebug())
            echo $element."<br/>";
        else        
            fwrite($this->handler,$element);    
    }   
}