<?php

class DomoprimeSimulationBase extends mfObject2 {
     
    protected static $fields=array('meeting_id','reference','month','year','status',
                                   'total_sale_without_tax',
                                   'total_sale_with_tax',
                                   'total_purchase_with_tax',
                                   'total_purchase_without_tax',                                   
                                   'total_tax','prime', 
                                   'comments','status_id','dated_at',                              
                                   'customer_id','creator_id','contract_id',
                                   'rest_in_charge_after_credit','tax_credit_limit',
                                    'qmac_value','rest_in_charge',
                                   'number_of_children','tax_credit_available',
                                   'one_euro','tax_credit','number_of_people','tax_credit_used',
        
                                    'is_last',
                                   'created_at','updated_at');
    const table="t_domoprime_iso_simulation"; 
    protected static $foreignKeys=array('meeting_id'=>'CustomerMeeting',    
                                        'customer_id'=>'Customer',
                                        'creator_id'=>'User',
                                        'contract_id'=>'CustomerContract',    
                                        //'status_id'=>'CustomerContractBillingStatus'
                                        ); 
    protected static $fieldsNull=array('dated_at','signed_at','meeting_id','contract_id'); // By default
    protected static $months=array("january","february","march","april","may",
                                   "june","july","august","september","october",
                                   "november","december");    
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
         if ($parameters instanceof CustomerContract)
             return $this->loadLastForContract($parameters);
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);     
      }   
    }
    
      protected function loadLastForContract(CustomerContract $contract)
    {                   
         $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('contract_id'=>$contract->get('id')))
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE contract_id='{contract_id}' AND status='ACTIVE'".
                           " ORDER BY id DESC ".
                           " LIMIT 0,1".
                           ";")
            ->makeSiteSqlQuery($this->site);   
        //echo $db->getQuery();
         return $this->rowtoObject($db);
    }
  /*  protected function loadByEmail($email)
    {
         $this->set('email',$email);
         $db=mfSiteDatabase::getInstance()->setParameters(array($email));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE email='%s';")
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
      $this->is_signed=isset($this->is_signed)?$this->is_signed:"NO";    
      $this->is_last=isset($this->is_last)?$this->is_last:"YES";  
      $this->status=isset($this->status)?$this->status:"ACTIVE";            
      $this->prime=isset($this->prime)?$this->prime:0.0;       
      $this->tax_credit=isset($this->tax_credit)?$this->tax_credit:0.0;  
      $this->tax_credit_used=isset($this->tax_credit_used)?$this->tax_credit_used:0.0;  
      $this->qmac=isset($this->qmac)?$this->qmac:0.0;  
      $this->one_euro=isset($this->one_euro)?$this->one_euro:'YES'; 
      $this->tax_credit_available=isset($this-> tax_credit_available)?$this->tax_credit_available:0.0;
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
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    function createFromContract($contract,$form,User $user)
    {       
        $this->set('month',date('m'));
        $this->set('year',date('Y'));        
        $this->set('contract_id',$contract);
        $this->set('meeting_id',$contract->hasMeeting()?$contract->getMeeting():null);
        $this->set('dated_at',$form->getValue('dated_at'));
        $this->set('customer_id',$contract->getCustomer());           
        $this->save();
        $this->updateLastFromContract();        
        $this->create($contract,$contract->getMeeting(),$form,$user);
        return $this;
    }        
    
    function createFromMeeting($meeting,User $user)
    {       
        $this->set('month',date('m'));
        $this->set('year',date('Y'));                
        $this->set('meeting_id',$meeting);
        $this->set('dated_at',date("Y-m-d H:i:s"));
        $this->set('customer_id',$meeting->getCustomer());  
        $contract=new CustomerContract($meeting,$this->getSite());
        if ($contract->isLoaded())
           $this->set('contract_id', $contract);
        $this->save();
        $this->updateLastFromMeeting();                        
        $this->create(null,$meeting,$user);
        return $this;
    }  
            
    function create($contract,$meeting,User $user)
    {                      
        $this->set('reference',$this->getFormattedReference());       
        $this->products=new DomoprimeSimulationProductCollection(null,$this->getSite());
        $request=new DomoprimeCustomerRequest($meeting,$this->getSite());        
        $products=$this->getSettings()->getProductsBySurfaces();
        $ids=new mfArray();            
        foreach (array('surface_wall','surface_top','surface_floor') as $surface)
        {           
            if (intval($request->get($surface))==0)
               continue;
            $ids[$surface]=$products[$surface];    
        }    
        foreach (ProductUtils::getProductsByIds($ids) as $product)
        {          
            $item=new DomoprimeSimulationProduct(null,$this->getSite());
            $item->add(array('product_id'=>$product->get('id'),
                             'title'=>$product->get('meta_title'),                           
                             'simulation_id'=>$this,                                    
                             'quantity'=>$request->get($ids->find($product->get('id')))));
           if ($contract && $contract->isLoaded())
               $item->set('contract_id',$contract);
           if ($meeting && $meeting->isLoaded())
               $item->set('meeting_id',$meeting);
           $item->set('purchase_price_without_tax',$product->getPurchasePrice());
        //   echo "PWT=".$product->getPurchasePrice()."<br/>";
        //   echo "Surface=".$item->get('quantity')."<br/>";           
           $item->set('purchase_price_with_tax',$product->getPurchasePriceWithTax());
           $item->set('sale_price_without_tax',$product->getSalePrice());
           $item->set('sale_price_with_tax',$product->getSalePriceWithTax());
           $item->set('total_purchase_price_with_tax',$product->getPurchasePriceWithTax() * $item->getQuantity() );
           $item->set('total_sale_price_with_tax',$product->getSalePriceWithTax() * $item->getQuantity());
           $item->set('total_purchase_price_without_tax',$product->getPurchasePrice() * $item->getQuantity());
           $item->set('total_sale_price_without_tax',$product->getSalePrice() * $item->getQuantity());        
           $this->products[$product->get('id')]=$item; 
        }            
        $this->products->save();

        // Sumarize by items
        $this->set('total_sale_without_tax',$this->products->getTotalSaleWithoutTax());
        $this->set('total_sale_with_tax',$this->products->getTotalSaleWithTax());
        $this->set('total_purchase_without_tax',$this->products->getTotalPurchaseWithoutTax());
        $this->set('total_purchase_with_tax',$this->products->getTotalPurchaseWithTax());
        $this->set('total_tax',$this->products->getTotalTax());
        $this->set('prime',$this->getTotalSaleWithTax() - $this->getSettings()->getRestInCharge());
        $this->set('creator_id',$user);
         if ($this->getSettings()->hasQuotationEngine())
        {
            //echo "====CREATION=====";
           $class=$this->getSettings()->getSimulationEngine();          
            if (!class_exists($class))
                throw new mfException(__('Engine is invalid.'));
            $this->engine=new $class($this);
            $this->engine->process();        
        }       
        $this->save();
        return $this;
    }
    
    function getSettings()
    {
        if ($this->settings===null)
        {
           $this->settings= DomoprimeIsoSettings::load($this->getSite());           
        }   
        return $this->settings;
    }
    
    
    function getMeeting()
    {
        if ($this->_meeting_id===null)
        {
            $this->_meeting_id=new CustomerMeeting($this->get('meeting_id'),$this->getSite());            
        }   
        return $this->_meeting_id;
    }
    
    function getCustomer()
    {
        if ($this->_customer_id===null)
        {
            $this->_customer_id=new Customer($this->get('customer_id'),$this->getSite());            
        }   
        return $this->_customer_id;
    }
    
    function getCreator()
    {
        if ($this->_creator_id===null)
        {
            $this->_creator_id=new User($this->get('creator_id'),'admin',$this->getSite());            
        }   
        return $this->_creator_id;
    }
    
    function hasCreator()
    {
       return (boolean)$this->get('creator_id');
    }
    
    function getProducts()
    {
        if ($this->products===null)
        {
            $this->products=new DomoprimeSimulationProductCollection(null,$this->getSite());
            
              $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('simulation_id'=>$this->get('id')))
                         ->setObjects(array('DomoprimeSimulationProduct'))
                         ->setQuery("SELECT {fields} FROM ".DomoprimeSimulationProduct::getTable().                                   
                                    " WHERE simulation_id='{simulation_id}' ".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());                
                if (!$db->getNumRows())
                    return $this->products;                           
               while ($items=$db->fetchObjects())
               {                     
                   $item=$items->getDomoprimeSimulationProduct();
                   $this->products[$item->get('id')]=$item;
                }     
            
        } 
        return $this->products;
    }
    
     function getProductsWithProducts()
    {
        if ($this->products_products===null)
        {
            $this->products_products=new ProductCollection(null,$this->getSite());           
              $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('simulation_id'=>$this->get('id')))                        
                         ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".Product::getTable().                                   
                                    " INNER JOIN ".DomoprimeSimulationProduct::getInnerForJoin('product_id').
                                    " WHERE simulation_id='{simulation_id}' ".                                    
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());                
                if (!$db->getNumRows())
                    return $this->products_products;                           
               while ($item=$db->fetchObject('Product'))
               {                                       
                   $this->products_products[$item->get('id')]=$item;
                }     
            
        } 
        return $this->products_products;
    }
    
    
    function getProductsWithItems()
    {
        if ($this->products===null)
        {
            $this->products=new DomoprimeSimulationProductCollection(null,$this->getSite());
            
              $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('simulation_id'=>$this->get('id')))
                         ->setObjects(array('DomoprimeSimulationProduct','DomoprimeSimulationProductItem','ProductItem'))
                         ->setQuery("SELECT {fields} FROM ".DomoprimeSimulationProduct::getTable().    
                                    " INNER JOIN ".DomoprimeSimulationProductItem::getInnerForJoin('simulation_product_id'). 
                                    " INNER JOIN ".DomoprimeSimulationProductItem::getOuterForJoin('item_id'). 
                                    " WHERE ".DomoprimeSimulationProduct::getTableField('simulation_id')."='{simulation_id}' ".
                                    " ORDER BY ".DomoprimeSimulationProductItem::getTableField('is_mandatory')." DESC ".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());             
                if (!$db->getNumRows())
                    return $this->products;                           
               while ($items=$db->fetchObjects())
               {                     
                   $item=$items->getDomoprimeSimulationProduct();
                   if (!isset($this->products[$item->get('id')]))
                        $this->products[$item->get('id')]=$item;
                   $items->getDomoprimeSimulationProductItem()->set('product_item_id',$items->getProductItem());
                   $this->products[$item->get('id')]->addItem($items->getDomoprimeSimulationProductItem());
                }     
            
        } 
        return $this->products;
    }
 
    function getTotalSaleWithoutTax()
    {
        return floatval($this->get('total_sale_without_tax'));                                  
    }
    
    function getFormattedTotalSaleWithoutTax()
    {
        return format_currency($this->getTotalSaleWithoutTax(),'EUR');
    }
    
    function getTotalSaleWithTax()
    {
        return floatval($this->get('total_sale_with_tax'));                                   
    }
    
    function getFormattedTotalSaleWithTax()
    {
        return format_currency($this->getTotalSaleWithTax(),'EUR');
    }
    
     function getTotalPurchaseWithoutTax()
    {
        return floatval($this->get('total_purchase_without_tax'));                                  
    }
    
    function getTotalPurchaseWithTax()
    {
        return floatval($this->get('total_purchase_with_tax'));                                      
    }
    
     function getTotalSaleTax()
    {
        return $this->getTotalSaleWithTax() - $this->getTotalSaleWithoutTax();                                  
    }
    
    
     function getFormattedTotalSaleTax()
    {
        return format_currency($this->getTotalSaleTax(),'EUR');                                  
    }
    
    function getQmac()
    {
        return floatval($this->get('qmac_value'));                                      
    }
    
    
     function getFormattedQmac()
    {
        return format_currency($this->getQmac(),'EUR');                                  
    }
    
    function hasPrimeOneEuro()
    {
        return $this->get('one_euro')=='YES';
    }
    
    function toArrayForSimulation()
    {
        $values=parent::toArray(array());       
        foreach (array(                       
                       'total_sale_with_tax'=>'FormattedTotalSaleWithTax',
                       'total_sale_without_tax'=>'FormattedTotalSaleWithoutTax',
                       'total_tax'=>'FormattedTotalSaleTax',
                       'prime'=>'FormattedPrime',
                       'reference'=>'FormattedReference',
                        'tax_credit'=>'FormattedTaxCreditUsed',            
                       'tax_credit_used'=>'FormattedTaxCredit',
                       'rest_in_charge'=>'FormattedRestInCharge',                      
                       'tax_credit_limit'=>'FormattedTaxCreditLimit',
                       'number_of_people'=>'FormattedNumberOfPeople',
                       'number_of_children'=>'FormattedNumberOfChildren',
                       'rest_in_charge_after_credit'=>'FormattedRestInChargeAfterCredit' ,
                       'tax_credit_avaiable'=>'FormattedTaxCreditAvailable'
                    ) as $name=>$method)
        {
            $method='get'.$method;
            $values[$name]=$this->$method();
        }     
        return $values;
    }
    
    function getPrime()
    {
        return floatval($this->get('prime'));    
       // $settings=DomoprimeSettings::load($this->getSite());
       // return $this->getTotalSaleWithTax() - $settings->getRestInCharge(); 
    }

    function getFormattedPrime()
    {
        return format_currency($this->getPrime(),'EUR'); 
    }  
    
    function getFormattedReference()
    {        
        $parameters=array('{id}'=>$this->get('id'));
        return strtr(DomoprimeSettings::load($this->getSite())->get('simulation_reference_format'), $parameters);   
    }  
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new DomoprimeSimulationFormatter($this);
        }   
        return  $this->formatter;
    }
    
    function hasDatedAt()
    {
        return $this->get('dated_at');
    }
    
    function updateFromMeeting($form,$user)
    { 
        return $this->updateFromContract($form, $user);
    }
    
    function updateFromContract($form,$user)
    {        
        // Remove all products and items
         $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('simulation_id'=>$this->get('id')))                       
                         ->setQuery("DELETE FROM ".DomoprimeSimulationProduct::getTable().                                       
                                    " WHERE ".DomoprimeSimulationProduct::getTableField('simulation_id')."='{simulation_id}' ".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite()); 
        
        
        $this->set('dated_at',$form->getValue('dated_at'));      
        $this->products=new DomoprimeSimulationProductCollection(null,$this->getSite());
        foreach ($form->getValue('products') as $value)
        {
           $item=new DomoprimeSimulationProduct(null,$this->getSite());
           $product=$form->getProducts()->getProductById($value['product_id']);
           $item->add(array('product_id'=>$value['product_id'],
                             'title'=>$product->get('meta_title'),                           
                             'simulation_id'=>$this,
                             'meeting_id'=>$this->get('meeting_id'),
                             'quantity'=>$value['quantity']));                
           $item->set('purchase_price_without_tax',$product->getPurchasePriceWithoutTax());
           $item->set('purchase_price_with_tax',$product->getPurchasePriceWithTax());
           $item->set('sale_price_without_tax',$product->getSalePriceWithoutTax());
           $item->set('sale_price_with_tax',$product->getSalePriceWithTax());
           $item->set('total_purchase_price_with_tax',$product->getPurchasePriceWithTax() * $item->getQuantity() );
           $item->set('total_sale_price_with_tax',$product->getSalePriceWithTax() * $item->getQuantity());
           $item->set('total_purchase_price_without_tax',$product->getPurchasePriceWithoutTax() * $item->getQuantity());
           $item->set('total_sale_price_without_tax',$product->getSalePriceWithoutTax() * $item->getQuantity());         
           $this->products[$value['product_id']]=$item; 
        }    
        $this->products->save();         
        
        $this->items=new DomoprimeSimulationProductItemCollection(null,$this->getSite());
        foreach ($form->getValue('products') as $product)
        {            
            foreach ($product['items'] as $value)
            {                                               
                $work= $form->getProducts()->getProductById($product['product_id']);
                $item=new  DomoprimeSimulationProductItem(null,$this->getSite());
                $item->add(array('simulation_id'=>$this,
                                 'quantity'=>$product['quantity'],
                                 'simulation_product_id'=>$this->products[$product['product_id']],
                                 'title'=>$work->getProductItems()->getItemById($value)->get('reference'),  
                                 'tax_id'=>$work->getProductItems()->getItemById($value)->get('tax_id'), 
                                 'item_id'=>$work->getProductItems()->getItemById($value),        
                              //   'product_id'=>$work->get('id'),
                             //    'product_item_id'=>$value,
                            ));
               // echo "<pre>"; var_dump($item->getProductItem()); echo "</pre>"; 
                $item->set('purchase_price_without_tax',$item->getProductItem()->getPurchasePriceWithoutTax());
                $item->set('purchase_price_with_tax',$item->getProductItem()->getPurchasePriceWithTax());
                $item->set('total_purchase_price_with_tax',$item->getProductItem()->getPurchasePriceWithTax() * $item->getQuantity() );
                $item->set('total_purchase_price_without_tax',$item->getProductItem()->getPurchasePriceWithoutTax() * $item->getQuantity());
                
                $item->set('sale_price_without_tax',$item->getProductItem()->getSalePriceWithoutTax());
                $item->set('sale_price_with_tax',$item->getProductItem()->getSalePriceWithTax());             
                $item->set('total_sale_price_with_tax',$item->getProductItem()->getSalePriceWithTax() * $item->getQuantity());              
                $item->set('total_sale_price_without_tax',$item->getProductItem()->getSalePriceWithoutTax() * $item->getQuantity()); 
                $this->items[]=$item;
            }    
        }    
        $this->items->save();
        
        
        // Sumarize by items
        $this->set('total_sale_without_tax',$this->items->getTotalSaleWithoutTax());
        $this->set('total_sale_with_tax',$this->items->getTotalSaleWithTax());
        $this->set('total_purchase_without_tax',$this->items->getTotalPurchaseWithoutTax());
        $this->set('total_purchase_with_tax',$this->items->getTotalPurchaseWithTax());
        $this->set('creator_id',$user);
         if ($this->getSettings()->hasSimulationEngine())
        {
           // echo "===UPDATE====";           
            $class=$this->getSettings()->getSimulationEngine();
            if (!class_exists($class))
                throw new mfException(__('Engine is invalid.'));
            $this->engine=new $class($this);
            $this->engine->process();                  
        }  
        
        
        $this->save();               
        return $this;
    }
    
    
  
    
    static function loadNumberOfSimulationsForContract(CustomerContract $contract)
    {        
        if ($contract->isNotLoaded())
            return false;
        if ($contract->simulations===null)
        {
             $db=mfSiteDatabase::getInstance()
                     ->setParameters(array('meeting_id'=>$contract->getMeeting()->get('id')))
                     ->setQuery("SELECT count(id) FROM ".self::getTable()." WHERE meeting_id='{meeting_id}';")
                     ->makeSiteSqlQuery($contract->getSite());           
             $row=$db->fetchRow();
             $contract->simulations=($row[0] > 0);  
            // var_dump($contract->getSimulations());
        }            
    }
    
    static function loadNumberOfSimulationsForMeeting(CustomerContract $meeting)
    {        
        if ($meeting->isNotLoaded())
            return false;
        if ($meeting->simulations===null)
        {
             $db=mfSiteDatabase::getInstance()
                     ->setParameters(array('meeting_id'=>$meeting->get('id')))
                     ->setQuery("SELECT count(id) FROM ".self::getTable()." WHERE meeting_id='{meeting_id}';")
                     ->makeSiteSqlQuery($meeting->getSite());                                          
             $row=$db->fetchRow();
             $meeting->simulations=($row[0] > 0);                
        }            
    }
    
    
    function enable()
    {
        if ($this->isNotLoaded())
            return $this;
       $this->set('status','ACTIVE');
       $this->save();
       return $this; 
    }
    
    function disable()
    {
         if ($this->isNotLoaded())
            return $this;
        $this->set('status','DELETE');
        $this->save();
        return $this;
    }
    
    function getStatusI18n()
    {
        return __($this->get('status'),array(),'messages','app_domoprime');
    }
    
    
    static function checkIfContractsWithSimulationFromSelection(mfArray $selection,$site=null)
    {                      
        $customers=new mfArray();
            $db=mfSiteDatabase::getInstance()
                     ->setParameters(array())
                     ->setQuery("SELECT ".Customer::getFieldsAndKeyWithTable().
                                " FROM ".CustomerContract::getTable().
                                " LEFT JOIN ".self::getInnerForJoin('contract_id').
                                " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').                             
                                " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."')".
                                " AND ".self::getTableField('id')." IS NULL".
                                ";")
                     ->makeSiteSqlQuery($site);                                         
           // echo $db->getQuery();
        if (!$db->getNumRows())
              return $customers;                           
        while ($item=$db->fetchObject('Customer'))
        {          
          $customers[$item->get('id')]= mb_strtoupper((string)$item);
        }         
        return $customers;
    }
    
     function hasMeeting()
    {
        return (boolean)$this->get('meeting_id');
    }
    
    function hasContract()
    {
        return (boolean)$this->get('contract_id');
    }
    
    function getContract()
    {
        if ($this->_contract_id===null)
        {
           $this->_contract_id= new CustomerContract($this->get('contract_id'),$this->getSite());
        }   
        return $this->_contract_id;
    }
    
     function hasSignedAt()
    {
        return (boolean)$this->get('signed_at');
    }
    
    
    static function getNumberOfSignedOperationsFromFilter($filter)
    {       
        $collection=new DomoprimeOperationCollection();
        $query=new mfQuery();
        $query->select("count(DISTINCT(".DomoprimeSimulation::getTableField('contract_id').")) as `number_of_operations`")
              ->select(DomoprimeSimulationProduct::getTableField('product_id'))
              ->from(DomoprimeSimulation::getTable())
              ->inner(DomoprimeSimulationProduct::getInnerForJoin('simulation_id'))
              ->inner(DomoprimeSimulation::getOuterForJoin('customer_id'))
              ->inner(DomoprimeSimulation::getOuterForJoin('contract_id'))
              ->where(DomoprimeSimulation::getTableField('is_signed')."='YES'")
              ->where($filter->getWhere())
              ->groupBy(DomoprimeSimulationProduct::getTableField('product_id'))              
                ;
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry()))               
                ->setQuery((string)$query)               
                ->makeSqlQuery(); 
         //echo $db->getQuery();      
         if (!$db->getNumRows())
            return $collection;    
        $product_surface=DomoprimeSettings::load()->getTypeNamesForProducts();
        while ($row=$db->fetchArray())
        {  
            $collection[$product_surface[$row['product_id']]]=$row['number_of_operations'];
        }
        //var_dump($collection);
        return $collection;
    }
    
    
    static function getNumberOfSurfacesSignedSimulationsFromFilter($filter)
    {
        $collection=new DomoprimeSurfaceCollection();
        $query=new mfQuery();
        $query->select("sum(".DomoprimeSimulationProduct::getTableField('quantity').") as `number_of_surfaces`")
              ->select(DomoprimeSimulationProduct::getTableField('product_id'))
              ->from(DomoprimeSimulation::getTable())
              ->inner(DomoprimeSimulationProduct::getInnerForJoin('simulation_id'))
              ->inner(DomoprimeSimulation::getOuterForJoin('customer_id'))
              ->inner(DomoprimeSimulation::getOuterForJoin('contract_id'))
              ->where(DomoprimeSimulation::getTableField('is_signed')."='YES'")
              ->where($filter->getWhere())
              ->groupBy(DomoprimeSimulationProduct::getTableField('product_id'))              
                ;
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry()))               
                ->setQuery((string)$query)               
                ->makeSqlQuery(); 
       // echo $db->getQuery();      
         if (!$db->getNumRows())
            return $collection;  
        $product_surface=DomoprimeSettings::load()->getTypeNamesForProducts();
        while ($row=$db->fetchArray())
        {  
            $collection["surface_".$product_surface[$row['product_id']]]=$row['number_of_surfaces'];
        }
        
      //  var_dump($collection);
        return $collection;
    }
    
    
     static function getNumberOfOperationsSimulationsFromFilter($filter)
    {       
        $collection=new DomoprimeOperationCollection();
        $query=new mfQuery();
        $query->select("count(DISTINCT(".DomoprimeSimulation::getTableField('contract_id').")) as `number_of_operations`")
              ->select(DomoprimeSimulationProduct::getTableField('product_id'))
              ->from(DomoprimeSimulation::getTable())
              ->inner(DomoprimeSimulationProduct::getInnerForJoin('simulation_id'))
              ->inner(DomoprimeSimulation::getOuterForJoin('customer_id'))
              ->inner(DomoprimeSimulation::getOuterForJoin('contract_id'))             
              ->where($filter->getWhere())
              ->groupBy(DomoprimeSimulationProduct::getTableField('product_id'))              
                ;
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry()))               
                ->setQuery((string)$query)               
                ->makeSqlQuery(); 
         //echo $db->getQuery();      
         if (!$db->getNumRows())
            return $collection;    
        $product_surface=DomoprimeSettings::load()->getTypeNamesForProducts();
        while ($row=$db->fetchArray())
        {  
            $collection[$product_surface[$row['product_id']]]=$row['number_of_operations'];
        }
        //var_dump($collection);
        return $collection;
    }
    
    
    static function getNumberOfSurfacesSimulationsFromFilter($filter)
    {
        $collection=new DomoprimeSurfaceCollection();
        $query=new mfQuery();
        $query->select("sum(".DomoprimeSimulationProduct::getTableField('quantity').") as `number_of_surfaces`")
              ->select(DomoprimeSimulationProduct::getTableField('product_id'))
              ->from(DomoprimeSimulation::getTable())
              ->inner(DomoprimeSimulationProduct::getInnerForJoin('simulation_id'))
              ->inner(DomoprimeSimulation::getOuterForJoin('customer_id'))
              ->inner(DomoprimeSimulation::getOuterForJoin('contract_id'))             
              ->where($filter->getWhere())
              ->groupBy(DomoprimeSimulationProduct::getTableField('product_id'))              
                ;
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry()))               
                ->setQuery((string)$query)               
                ->makeSqlQuery(); 
       // echo $db->getQuery();      
         if (!$db->getNumRows())
            return $collection;  
        $product_surface=DomoprimeSettings::load()->getTypeNamesForProducts();
        while ($row=$db->fetchArray())
        {  
            $collection["surface_".$product_surface[$row['product_id']]]=$row['number_of_surfaces'];
        }
        
      //  var_dump($collection);
        return $collection;
    }
    
    static function getNumberOfContractsSimulationsFromFilter($filter)
    {
        $collection=new DomoprimeOperationCollection();
        $query=new mfQuery();
        $query->select("count(DISTINCT(".DomoprimeSimulation::getTableField('contract_id').")) as `number_of_contracts`")
              ->select(DomoprimeSimulationProduct::getTableField('product_id'))
              ->from(DomoprimeSimulation::getTable())
              ->inner(DomoprimeSimulationProduct::getInnerForJoin('simulation_id'))
              ->inner(DomoprimeSimulation::getOuterForJoin('customer_id'))
              ->inner(DomoprimeSimulation::getOuterForJoin('contract_id'))             
              ->where($filter->getWhere())
            //  ->groupBy(DomoprimeSimulation::getTableField('contract_id'))              
              ->groupBy(DomoprimeSimulationProduct::getTableField('product_id'))              
                ;
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry()))               
                ->setQuery((string)$query)               
                ->makeSqlQuery(); 
      // echo $db->getQuery();      
         if (!$db->getNumRows())
            return $collection;  
        $product_surface=DomoprimeSettings::load()->getTypeNamesForProducts();
        while ($row=$db->fetchArray())
        {  
            $collection[$product_surface[$row['product_id']]]=$row['number_of_contracts'];
        }
        
      //  var_dump($collection);
        return $collection;
    }
    
       function getTotalTax()
    {
        return floatval($this->get('total_tax'));
    }
    
    
    function getFilenameForPdf()
    {
        return  mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/data/domoprime/simulations/".$this->get('id')."/".__("simulation")."_".$this->get('reference')."_".$this->get('id').".pdf";       
    }
    
    
    function toArrayForPdf()
    {
        $values=parent::toArray(array());       
        foreach (array(                       
                       'total_sale_with_tax'=>'FormattedTotalSaleWithTax',
                       'total_sale_without_tax'=>'FormattedTotalSaleWithoutTax',
                       'total_tax'=>'FormattedTotalSaleTax',
                       'prime'=>'FormattedPrime',
                       'reference'=>'FormattedReference',
                        'tax_credit'=>'FormattedTaxCreditUsed',            
                       'tax_credit_used'=>'FormattedTaxCredit',
                       'rest_in_charge'=>'FormattedRestInCharge',                      
                       'tax_credit_limit'=>'FormattedTaxCreditLimit',
                       'number_of_people'=>'FormattedNumberOfPeople',
                       'number_of_children'=>'FormattedNumberOfChildren',
                       'rest_in_charge_after_credit'=>'FormattedRestInChargeAfterCredit' ,
                        'tax_credit_avaiable'=>'FormattedTaxCreditAvailable'
                    ) as $name=>$method)
        {
            $method='get'.$method;
            $values[$name]=$this->$method();
        }     
        return $values;
    }
    
    function updateLastFromContract()
    {
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('contract_id'=>$this->get('contract_id'),'id'=>$this->get('id')))               
                ->setQuery("UPDATE ".self::getTable()." SET is_last='NO' WHERE  contract_id='{contract_id}' AND id!='{id}'".
                           ";")               
                ->makeSqlQuery();
        return $this;
    }
    
    function updateLastFromMeeting()
    {
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('meeting_id'=>$this->get('meeting_id'),'id'=>$this->get('id')))               
                ->setQuery("UPDATE ".self::getTable()." SET is_last='NO' WHERE meeting_id='{meeting_id}' AND id!='{id}'".
                           ";")               
                ->makeSqlQuery();        
        return $this; 
    }
    
    
    static function setContractForSimulationsFromMeeting(CustomerContract $contract)
    {
       if (!$contract->hasMeeting())
           return ;         
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('contract_id'=>$contract->get('id'),'meeting_id'=>$contract->getMeeting()->get('id')))               
                ->setQuery("UPDATE ".self::getTable().
                           " SET contract_id='{contract_id}'".
                           " WHERE meeting_id='{meeting_id}'".
                           ";")               
                ->makeSiteSqlQuery($contract->getSite());       
    }
    
    
    function getTaxCredit()
    {
        return floatval($this->get('tax_credit'));    
       // $settings=DomoprimeSettings::load($this->getSite());
       // return $this->getTotalSaleWithTax() - $settings->getRestInCharge(); 
    }
    
     function getTaxCreditUsed()
    {
        return floatval($this->get('tax_credit_used'));    
       // $settings=DomoprimeSettings::load($this->getSite());
       // return $this->getTotalSaleWithTax() - $settings->getRestInCharge(); 
    }

    function getFormattedTaxCredit()
    {
        return format_currency($this->getTaxCredit(),'EUR'); 
    } 
    
    function getFormattedTaxCreditUsed()
    {
        return format_currency($this->getTaxCreditUsed(),'EUR'); 
    } 
        
    
    function getFormattedRestInCharge()
    {
        return format_currency($this->getRestInCharge(),'EUR'); 
    }
    
    function getNumberOfPeople()
    {
        return floatval($this->get('number_of_people'));
    }
    
     function getNumberOfChildren()
    {
        return floatval($this->get('number_of_children'));
    }
    
     function getRestInCharge()
    {
        return floatval($this->get('rest_in_charge'));
    }
    
      function getRestInChargeAfterCredit()
    {
        return floatval($this->get('rest_in_charge_after_credit'));
    }
    
    function getTaxCreditLimit()
    {
        return floatval($this->get('tax_credit_limit')); 
    }
    
    function getFormattedTaxCreditLimit()
    {
        return format_currency($this->getTaxCreditLimit(),"EUR");
    }
    
    function getFormattedRestInChargeAfterCredit()
    {
        return format_currency($this->getRestInChargeAfterCredit(),"EUR");
    }
    
    function getFormattedNumberOfChildren()
    {
        return format_number($this->getNumberOfChildren(),"#.0");
    }
    
     function getFormattedNumberOfPeople()
    {
        return format_number($this->getNumberOfPeople(),"#.0");
    }
    
      function getTaxCreditAvailable()
    {
        return floatval($this->get('tax_credit_avaiable')); 
    }
    
    function getFormattedTaxCreditAvailable()
    {
        return format_currency($this->getTaxCreditAvailable(),"EUR");
    }
    
    function getProductsSurfaces()
    {
        $values=array();
        foreach ($this->getSettings()->getSurfaceNamingsForProducts() as $product_id=>$surface_name)
        {
            if (isset($this->products[$product_id]))
                $values[$surface_name]=$this->products[$product_id]->get('quantity');
            else
                $values[$surface_name]=0;
        }    
        return $values;     
    }
}
