<?php


class CustomerContractProductItemBase extends mfObject2 {
     
    
    protected static $fields=array('contract_id','item_id','product_id',
                                                                                                     
                                   'created_at','updated_at');
    const table="t_customers_contract_product_item"; 
    protected static $foreignKeys=array('contract_id'=>'CustomerContract',        
                                        'item_id'=>'ProductItem',
                                        'product_id'=>'Product'); // By default
   
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;       
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {         
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
            if (isset($parameters['product']) && $parameters['product'] instanceof Product && isset($parameters['contract']) && $parameters['contract'] instanceof CustomerContract)
              return $this->loadbyProductAndContract($parameters['product'],$parameters['contract']); 
        /*   if (isset($parameters['product']) && isset($parameters['contract']))
             return $this->loadbyProductAndContract($parameters['product'],$parameters['contract']); */
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         
      }   
    }
    
     protected function loadbyProductAndContract(Product $product,CustomerContract $contract)
    {       
         $this->set('product_id',$product);
         $this->set('contract_id',$contract);      
         $db=mfSiteDatabase::getInstance()->setParameters(array('product_id'=>$product->get('id'),'contract_id'=>$contract->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE product_id='{product_id}' AND contract_id='{contract_id}';")
            ->makeSiteSqlQuery($this->site);    
         return $this->rowtoObject($db);
    }
    
 /*  protected function loadbyProductIdAndContractId($product_id,$contract_id)
    {
         $this->set('product_id',$product_id);
         $this->set('contract_id',$contract_id);      
         $db=mfSiteDatabase::getInstance()->setParameters(array('product_id'=>$product_id,'contract_id'=>$contract_id));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE product_id='{product_id}' AND contract_id='{contract_id}';")
            ->makeSiteSqlQuery($this->site);          
         return $this->rowtoObject($db);
    }*/
    
   
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
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
    
   /* protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('product_id'=>$this->get('product_id'),'contract_id'=>$this->get('contract_id'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable().
                    " WHERE contract_id='{contract_id}' AND product_id='{product_id}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }*/
    
   
   
    public function getProduct()
    {      
        return $this->_product_id=$this->_product_id===null?new Product($this->get('product_id'),$this->getSite()):$this->_product_id;
    }
    
    function getContract()
    {
        return $this->_contract_id=$this->_contract_id===null?new CustomerContract($this->get('contract_id'),$this->getSite()):$this->_contract_id;
    }       
    
     public function getItem()
    {      
        return $this->_item_id=$this->_item_id===null?new ProductItem($this->get('item_id'),$this->getSite()):$this->_item_id;
    }
      
    
}
