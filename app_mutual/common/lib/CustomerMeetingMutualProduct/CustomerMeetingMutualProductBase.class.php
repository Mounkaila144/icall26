<?php

class CustomerMeetingMutualProductBase extends mfObject2 {
    
    // 'quantity'=1 (pas utiliser), 'sale_price_with_tax'(utilisé)
    protected static $fields=array('quantity','tva_id','sale_price_with_tax','purchase_price_with_tax','sale_price_without_tax',
                                   'purchase_price_without_tax','total_sale_price_with_tax','total_purchase_price_with_tax',
                                   'total_sale_price_without_tax','total_purchase_price_without_tax',
                                   'meeting_id','product_id','is_active','status','created_at','updated_at');
    const table="t_app_mutual_customers_meeting_products"; 
    protected static $foreignKeys=array('meeting_id'=>'CustomerMeeting',
                                        'product_id'=>'MutualProduct',
                                        ); 
    protected static $fieldsNull=array('tva_id','created_at','updated_at'); // By default
    
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
    
    protected function loadbyProductIdAndSalePriceWithTaxAndMeetingId($product_id,$sale_price_with_tax,$meeting_id)
    {
        $db = mfSiteDatabase::getInstance();
        $db->setParameters(array('product_id'=>$product_id,'sale_price_with_tax'=>$sale_price_with_tax,'meeting_id'=>$meeting_id))
           ->setQuery("SELECT * FROM ".self::getTable()." WHERE meeting_id='{meeting_id}' AND product_id='{product_id}' AND sale_price_with_tax='{sale_price_with_tax}';")
           ->makeSiteSqlQuery($this->site);  
        return $this->rowtoObject($db);
    }        
    
    protected function getDefaults()
    {
        $this->quantity=isset($this->quantity)?$this->quantity:1;
        $this->purchase_price_with_tax=isset($this->purchase_price_with_tax)?$this->purchase_price_with_tax:0;
        $this->sale_price_without_tax=isset($this->sale_price_without_tax)?$this->sale_price_without_tax:0;
        $this->purchase_price_without_tax=isset($this->purchase_price_without_tax)?$this->purchase_price_without_tax:0;
        $this->total_sale_price_with_tax=isset($this->total_sale_price_with_tax)?$this->total_sale_price_with_tax:0;
        $this->total_purchase_price_with_tax=isset($this->total_purchase_price_with_tax)?$this->total_purchase_price_with_tax:0;
        $this->total_sale_price_without_tax=isset($this->total_sale_price_without_tax)?$this->total_sale_price_without_tax:0;
        $this->total_purchase_price_without_tax=isset($this->total_purchase_price_without_tax)?$this->total_purchase_price_without_tax:0;
        $this->is_active=isset($this->is_active)?$this->is_active:'NO';
        $this->status=isset($this->status)?$this->status:'ACTIVE';
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
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
        $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
        $db->setParameters(array('meeting_id'=>$this->get('meeting_id'),'product_id'=> $this->get('product_id'),$this->getKey()))
           ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE meeting_id='{meeting_id}' AND product_id='{product_id}' ".$key_condition)
           ->makeSiteSqlQuery($this->site);      
    }
       
    function hasMeeting()
    {
        return (boolean)$this->get('meeting_id');
    }
    
    public function setMeeting($meeting)
    {      
        $this->_meeting_id = $meeting;
        return $this;
    }
    
    public function getMeeting()
    {      
        if (!$this->_meeting_id)
        {
            $this->_meeting_id = new CustomerMeeting($this->get('meeting_id'),$this->getSite());          
        }    
        return $this->_meeting_id;
    }
       
    function hasProduct()
    {
        return (boolean)$this->get('product_id');
    }
    
    public function setProduct($product)
    {      
        $this->_product_id = $product;
        return $this;
    }
    
    public function getProduct()
    {      
        if (!$this->_product_id)
        {
            $this->_product_id = new MutualProduct($this->get('product_id'),$this->getSite());          
        }    
        return $this->_product_id;
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
    
    function getSalePriceWithTaxI18n()
    {
        return format_currency($this->get('sale_price_with_tax'),'EUR');
    }
    
    public static function updateMeetingMutualProducts(CustomerMeeting $meeting, NewMutualProductForMeetingForm $form,$site=null)
    {
        $products_to_save = $form->getValuesAsCollection();
        $products_for_update = new CustomerMeetingMutualProductCollection(null,$site);
        $products = new mfArray();
        foreach ($products_to_save as $key => $value)
            $products[$value->get('product_id')] = $value->get('sale_price_with_tax');
        
        // Get meeting_products by meeting_id AND product_id
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array("meeting_id"=>$meeting->get('id')))               
            ->setQuery("SELECT * FROM ". CustomerMeetingMutualProduct::getTable()." WHERE meeting_id='{meeting_id}' AND product_id IN('".$products->getKeys()->implode("','")."');")               
            ->makeSiteSqlQuery($site);
        
        if ($db->getNumRows())
        {   
            while($item = $db->fetchObject("CustomerMeetingMutualProduct"))
            {
                $item->loaded();
                $products_for_update[$item->get('id')] = $item->set('sale_price_with_tax',$products[$item->get("product_id")]);
            }
            
            //save updates
            $products_for_update->loaded()->save();
        }                
        // delete not existing products
        // Remove them
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array("meeting_id"=>$meeting->get('id')))                             
            ->setQuery("DELETE FROM ".CustomerMeetingMutualProduct::getTable().($products->isEmpty()?"":" WHERE meeting_id={meeting_id} AND product_id NOT IN('".$products->getKeys()->implode("','")."');"))               
            ->makeSiteSqlQuery($site); 
        
        //filtre new products
        foreach ($products_for_update as $product){
            $products_to_save[$product->get('product_id')] =$product;
        }
        $products_to_save->save();
        return $products_to_save;
    }
    
    function getFormatter()
    {
        if($this->formatter===null)
            $this->formatter = new CustomerMeetingMutualProductFormatter($this);
        return $this->formatter;
    }
}
