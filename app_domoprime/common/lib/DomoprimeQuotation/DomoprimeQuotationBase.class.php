<?php

class DomoprimeQuotationBase extends mfObject2 {
     
    protected static $fields=array('meeting_id','reference','month','year','status',
                                   'total_sale_without_tax','rest_in_charge_after_credit',
                                   'total_sale_with_tax','tax_credit_limit',
                                   'total_purchase_with_tax',
                                   'total_purchase_without_tax',                                            
                                   'total_tax','prime', 'tax_credit_available',                                 
                                   'total_sale_discount_with_tax',
                                   'total_sale_discount_without_tax',
                                   'comments','status_id','dated_at',   'engine',
                                   'remarks','header','footer','qmac_value','rest_in_charge',
                                   'customer_id','creator_id','contract_id','number_of_children',
                                   'one_euro','tax_credit','number_of_people','tax_credit_used',
                                   'is_signed','signed_at','is_last',
                                   'fixed_prime','fee_file',
                                
                                   'total_sale_101_with_tax',
                                   'total_sale_101_without_tax',        
                                   'total_sale_102_with_tax',
                                   'total_sale_102_without_tax',        
                                   'total_sale_103_with_tax',
                                   'total_sale_103_without_tax',
        
                                   'total_added_with_tax_wall',
                                   'total_added_without_tax_wall',        
                                   'total_added_with_tax_floor',
                                   'total_added_without_tax_floor',        
                                   'total_added_with_tax_top',
                                   'total_added_without_tax_top',
        
                                   'total_restincharge_with_tax_wall',
                                   'total_restincharge_without_tax_wall',        
                                   'total_restincharge_with_tax_floor',
                                   'total_restincharge_without_tax_floor',        
                                   'total_restincharge_with_tax_top',
                                   'total_restincharge_without_tax_top','company_id',
                                   'subvention','bbc_subvention','cee_prime','passoire_subvention',
                                   'pack_prime','ana_prime','ana_pack_prime','number_of_parts','ite_prime',
                                   'taxes','work_id', 'discount_amount', 'mode', 
                                   'subvention_type_id','type','polluter_id','calculation_id',
                                   'created_at','updated_at');
    const table="t_domoprime_quotation"; 
    protected static $foreignKeys=array('meeting_id'=>'CustomerMeeting',    
                                        'customer_id'=>'Customer',
                                        'creator_id'=>'User',
                                        'subvention_type_id'=>'DomoprimeSubventionType',
                                        'contract_id'=>'CustomerContract',    
                                        'company_id'=>'CustomerContractCompany',
                                        'work_id'=>'DomoprimeCustomerContractWork',
                                        'polluter_id'=>'DomoprimePollutingCompany',
                                        'calculation_id'=>'DomoprimeCalculation',
                                        ); 
    protected static $fieldsNull=array('calculation_id','dated_at','signed_at','meeting_id','creator_id','polluter_id','contract_id','tax_credit','company_id','work_id','subvention_type_id'); // By default
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
         if ($parameters instanceof CustomerMeeting)
             return $this->loadLastForMeeting($parameters);
         if ($parameters instanceof DomoprimeCustomerContractWork)
             return $this->loadLastForWork($parameters);
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);     
      }   
    }
        
     protected function loadLastForWork(DomoprimeCustomerContractWork $work)
    {                   
         $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('work_id'=>$work->get('id')))
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE work_id='{work_id}' AND status='ACTIVE'".
                           " ORDER BY id DESC ".
                           " LIMIT 0,1".
                           ";")
            ->makeSiteSqlQuery($this->site);   
        //echo $db->getQuery();
         return $this->rowtoObject($db);
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
    
     protected function loadLastForMeeting(CustomerMeeting $meeting)
    {                   
         $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('meeting_id'=>$meeting->get('id')))
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE meeting_id='{meeting_id}' AND status='ACTIVE'".
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
      $this->fixed_prime=isset($this->fixed_prime)?$this->fixed_prime:0.0;   
      $this->tax_credit=isset($this->tax_credit)?$this->tax_credit:0.0;  
      $this->tax_credit_used=isset($this->tax_credit_used)?$this->tax_credit_used:0.0;  
      $this->qmac=isset($this->qmac)?$this->qmac:0.0;  
      $this->one_euro=isset($this->one_euro)?$this->one_euro:'YES'; 
      $this->tax_credit_available=isset($this->tax_credit_available)?$this->tax_credit_available:0.0;
      $this->total_sale_without_tax=isset($this->total_sale_without_tax)?$this->total_sale_without_tax:0.0;
      $this->total_sale_with_tax=isset($this->total_sale_with_tax)?$this->total_sale_with_tax:0.0;
      $this->rest_in_charge_after_credit=isset($this->rest_in_charge_after_credit)?$this->rest_in_charge_after_credit:0.0;
      $this->tax_credit_limit=isset($this->tax_credit_limit)?$this->tax_credit_limit:0.0;
      $this->total_purchase_with_tax=isset($this->total_purchase_with_tax)?$this->total_purchase_with_tax:0.0;
      $this->total_purchase_without_tax=isset($this->total_purchase_without_tax)?$this->total_purchase_without_tax:0.0;
      $this->total_tax=isset($this->total_tax)?$this->total_tax:0.0;
      $this->total_sale_discount_with_tax=isset($this->total_sale_discount_with_tax)?$this->total_sale_discount_with_tax:0.0;
      $this->total_sale_discount_without_tax=isset($this->total_sale_discount_without_tax)?$this->total_sale_discount_without_tax:0.0;
      $this->mode=isset($this->mode)?$this->mode:'simple';
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
        $this->set('company_id',$contract->get('company_id'));     
        $this->set('creator_id',$user);
        $this->set('calculation_id',new DomoprimeCalculation($contract));
        $this->save();
        $this->updateLastFromContract();        
        $this->create($contract,$contract->getMeeting(),$form,$user);
        $contract->set('is_signed','NO')->save();
        return $this;
    }        
    
    function createFromMeeting($meeting,$form,User $user)
    {       
        $this->set('month',date('m'));
        $this->set('year',date('Y'));                
        $this->set('meeting_id',$meeting);
        $this->set('dated_at',$form->getValue('dated_at'));
        $this->set('customer_id',$meeting->getCustomer());  
        $this->set('company_id',$meeting->get('company_id')); 
        $this->set('creator_id',$user);
         $this->set('calculation_id',new DomoprimeCalculation($meeting));
        $contract=new CustomerContract($meeting,$this->getSite());
        if ($contract->isLoaded())
           $this->set('contract_id', $contract);
        $this->save();
        $this->updateLastFromMeeting();                        
        $this->create(null,$meeting,$form,$user);
        return $this;
    }  
            
    function create($contract,$meeting,$form,User $user)
    {                  
        if ($this->getSettings()->hasQuotationEngine())
        {                     
            $class=$this->getSettings()->getQuotationEngine();          
            if (!class_exists($class))
                throw new mfException(__('Quotation Engine is invalid.'));
            $this->engine=new $class($this);
            $this->engine->create($form,$user);          
        }  
        else
        {                         
            $this->set('reference',$this->getFormattedReference());
            $this->products=new DomoprimeQuotationProductCollection(null,$this->getSite());
            foreach ($form->getValue('products') as $value)
            {
               $item=new DomoprimeQuotationProduct(null,$this->getSite());
               $product=$form->getProducts()->getProductById($value['product_id']);                          
               $item->add(array('product_id'=>$value['product_id'],
                                 'title'=>$product->get('meta_title'),                           
                                 'quotation_id'=>$this,                                    
                                 'quantity'=>$value['quantity']));                
               if ($contract && $contract->isLoaded())
                   $item->set('contract_id',$contract);
               if ($meeting && $meeting->isLoaded())
                   $item->set('meeting_id',$meeting);
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

            $this->items=new DomoprimeQuotationProductItemCollection(null,$this->getSite());
            foreach ($form->getValue('products') as $product)
            {            
                foreach ($product['items'] as $value)
                {                                               
                    $work= $form->getProducts()->getProductById($product['product_id']);
                    $item=new  DomoprimeQuotationProductItem(null,$this->getSite());
                    $item->add(array('quotation_id'=>$this,
                                     'quantity'=>$product['quantity'] * $work->getProductItems()->getItemById($value)->getCoefficient(),
                                     'quotation_product_id'=>$this->products[$product['product_id']],
                                     'title'=>$work->getProductItems()->getItemById($value)->get('reference'),  
                                     'tva_id'=>$work->getProductItems()->getItemById($value)->get('tva_id'), 
                                     'item_id'=>$work->getProductItems()->getItemById($value),     
                                     'is_mandatory'=>$work->getProductItems()->getItemById($value)->get('is_mandatory'),  
                                     'unit'=>$work->getProductItems()->getItemById($value)->get('unit'), 
                                     'coefficient'=>$work->getProductItems()->getItemById($value)->getCoefficient(),  
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
                    $item->set('total_tax',$item->getProductItem()->getTax()->getRate() * $item->getTotalSalePriceWithoutTax());
                    $this->items[]=$item;
                }    
            }    
            $this->items->save();

            // Sumarize by items
            $this->set('total_sale_without_tax',$this->items->getTotalSaleWithoutTax());
            $this->set('total_sale_with_tax',$this->items->getTotalSaleWithTax());
            $this->set('total_purchase_without_tax',$this->items->getTotalPurchaseWithoutTax());
            $this->set('total_purchase_with_tax',$this->items->getTotalPurchaseWithTax());
            $this->set('total_tax',$this->items->getTotalTax());
            $this->set('prime',$this->items->getTotalSaleWithTax() - $this->getSettings()->getRestInCharge());        
            $this->set('creator_id',$user);
            $this->save();
        }    
        return $this;
    }
    
    function getDatedAt()
    {
        return new DateFormatter($this->get('dated_at'));
    }
    
  /*  function create2FromContract($contract,$form,User $user)
    {       
        $this->set('month',date('m'));
        $this->set('year',date('Y'));        
        $this->set('contract_id',$contract);     
        $this->set('dated_at',$form->getValue('dated_at'));
        $this->set('customer_id',$contract->getCustomer());           
        $this->save();
        $this->updateLastFromContract();        
        if ($this->getSettings()->hasQuotationEngine())
        {                     
            $class=$this->getSettings()->getQuotationEngine();          
            if (!class_exists($class))
                throw new mfException(__('Quotation Engine is invalid.'));
            $this->engine=new $class($this);
            $this->engine->create($form,$user);          
        }               
        $contract->set('is_signed','NO')->save();
        return $this;
    }  */ 
    
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
    
    
    function getSettings()
    {
        if ($this->settings===null)
        {
           $this->settings= new DomoprimeSettings(null,$this->getSite());
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
        
    function getPolluter()
    {
        return $this->_polluter_id=$this->_polluter_id===null?$this->_polluterid=new DomoprimePollutingCompany($this->get('polluter_id'),$this->getSite()):$this->_polluter_id;
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
            $this->products=new DomoprimeQuotationProductCollection(null,$this->getSite());
            
              $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('quotation_id'=>$this->get('id')))
                         ->setObjects(array('DomoprimeQuotationProduct'))
                         ->setQuery("SELECT {fields} FROM ".DomoprimeQuotationProduct::getTable().                                   
                                    " WHERE quotation_id='{quotation_id}' ".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());                
                if (!$db->getNumRows())
                    return $this->products;                           
               while ($items=$db->fetchObjects())
               {                     
                   $item=$items->getDomoprimeQuotationProduct();
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
                         ->setParameters(array('quotation_id'=>$this->get('id')))                        
                         ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".Product::getTable().                                   
                                    " INNER JOIN ".DomoprimeQuotationProduct::getInnerForJoin('product_id').
                                    " WHERE quotation_id='{quotation_id}' ".                                    
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
            $this->products=new DomoprimeQuotationProductCollection(null,$this->getSite());
        //   $settings_type_product=DomoprimeSettings::load($this->getSite())->getTypeNamesForProducts();
              $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('quotation_id'=>$this->get('id')))
                         ->setObjects(array('Product','DomoprimeQuotationProduct','DomoprimeQuotationProductItem','ProductItem'))
                         ->setQuery("SELECT {fields} FROM ".DomoprimeQuotationProduct::getTable().    
                                    " INNER JOIN ".DomoprimeQuotationProductItem::getInnerForJoin('quotation_product_id'). 
                                    " INNER JOIN ".DomoprimeQuotationProductItem::getOuterForJoin('item_id'). 
                                    " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('product_id'). 
                                    " WHERE ".DomoprimeQuotationProduct::getTableField('quotation_id')."='{quotation_id}' ".
                                  //  " ORDER BY ".DomoprimeQuotationProductItem::getTableField('id')." ASC ".
                                     " ORDER BY ".DomoprimeQuotationProductItem::getTableField('is_mandatory')." DESC ".
                                   // " ORDER BY ".DomoprimeQuotationProductItem::getTableField('is_mandatory')." DESC ". 
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());   
          //   echo $db->getQuery(); die(__METHOD__);
                if (!$db->getNumRows())
                    return $this->products;                           
               while ($items=$db->fetchObjects())
               {                     
                   $item=$items->getDomoprimeQuotationProduct();
                   if (!isset($this->products[$item->get('id')]))
                   {    
                        $item->set('product_id',$items->getProduct());
                        //$this->products[$settings_type_product[$item->get('product_id')]]=$item;
                        $this->products[$item->get('id')]=$item;
                   }     
                   $items->getDomoprimeQuotationProductItem()->set('product_item_id',$items->getProductItem());
                   $items->getDomoprimeQuotationProductItem()->set('product_id',$items->getProduct());
                 //  $this->products[$settings_type_product[$item->get('product_id')]]->addItem($items->getDomoprimeQuotationProductItem());
                     $this->products[$item->get('id')]->addItem($items->getDomoprimeQuotationProductItem());
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
    
     function hasPolluter()
    {
        return (boolean)$this->get('polluter_id');
    }
    
    function toArrayForQuotation()
    {
        $values=parent::toArray(array());       
        foreach (array(                       
                       'total_sale_with_tax'=>'FormattedTotalSaleWithTax',
                       'total_sale_without_tax'=>'FormattedTotalSaleWithoutTax',
                       'total_tax'=>'FormattedTotalSaleTax',
                       'prime'=>'FormattedPrime',
                       'fixed_prime'=>'FormattedFixedPrime',
                       'tax_credit'=>'FormattedTaxCreditUsed',            
                       'tax_credit_used'=>'FormattedTaxCredit',
                       'rest_in_charge'=>'FormattedRestInCharge',
                       'reference'=>'FormattedReference',
                       'tax_credit_limit'=>'FormattedTaxCreditLimit',
                       'number_of_people'=>'FormattedNumberOfPeople',
                       'number_of_children'=>'FormattedNumberOfChildren',                       
                       'rest_in_charge_after_credit'=>'FormattedRestInChargeAfterCredit',
                       'tax_credit_avaiable'=>'FormattedTaxCreditAvailable',
                       'prime_oneeuro'=>'FormattedCurrencyPrimeOneEuro',
                       'prime_one_euro'=>'FormattedPrimeOneEuro', 
                       'prime_rounded_one_euro'=>'FormattedRoundedPrimeOneEuro',
                       'fee_file'=>'FormattedFeeFile',
                       'fee_file_without_tax'=>'FormattedFeeFileWithoutTax',
                       'total_sale_with_tax_and_fee'=>'FormattedTotalPriceWithTaxAndFeeFile',
                       'total_sale_without_tax_and_fee'=>'FormattedTotalPriceWithoutTaxAndFeeFile',
                       'tax_fee_file_eur'=>'FormattedTaxFeeFile',
                       'tax_fee_file'=>'TaxFeeFile',                      
                       'total_tax'=>'FormattedTotalTax',
                       'total_sale_with_tax_minus_fee'=>'FormattedTotalPriceWithTaxMinusFeeFile',
                       'total_sale_without_tax_minus_fee'=>'FormattedTotalPriceWithoutTaxMinusFeeFile',
                       'total_sale_discount_with_tax'=>'FormattedTotalSaleDiscountWithTax',
                       'total_sale_discount_without_tax'=>'FormattedTotalSaleDiscountWithoutTax',
                       'total_discount_tax'=>'FormattedTotalSaleDiscountTax',                        
                       'total_sale_discount_with_tax_minus_fee'=>'FormattedTotalDiscountPriceWithTaxMinusFeeFile',
                       'total_sale_without_tax_minus_fee'=>'FormattedTotalDiscountPriceWithoutTaxMinusFeeFile',
                       'total_discount_tax'=>'FormattedDiscountTotalTax',
                       'total_gross_sale_with_tax'=>'FormattedTotalGrossSaleWithTax',
                       'total_gross_sale_without_tax'=>'FormattedTotalGrossSaleWithoutTax',
                       'total_gross_tax'=>'FormattedTotalGrossTax',
                       'total_gross_tax_with_fee'=>'FormattedTotalGrossTaxWithFeeFile',                       
                       'total_fee_file_without_tax'=>'FormattedTotalFeeFileWithoutTax',
                       'total_gross_sale_fee_file_without_tax'=>'FormattedTotalGrossSaleAndFeeFileWithoutTax',
                       'fee_file_tax_rate'=>'FormattedFeefileTaxRate',
                       'total_gross_sale_fee_file_with_tax'=>'FormattedTotalGrossSaleAndFeeWithTax',
                       'total_gross_sale_fee_file_minus_prime_with_tax'=>'FormattedTotalGrossSaleAndFeeMinusPrimeWithTax',
                       
                       'total_sale_101_with_tax'=>'FormattedTotalSale101WithTax',
                       'total_sale_101_without_tax'=>'FormattedTotalSale101WithoutTax',            
                       'total_sale_102_with_tax'=>'FormattedTotalSale102WithTax',
                       'total_sale_102_without_tax'=>'FormattedTotalSale102WithoutTax',            
                       'total_sale_103_with_tax'=>'FormattedTotalSale103WithTax',
                       'total_sale_103_without_tax'=>'FormattedTotalSale103WithoutTax',
            
                       'global_sale_with_tax'=>'FormattedGlobalSaleWithTax',
                       'global_sale_without_tax'=>'FormattedGlobalSaleWithoutTax',    
            
                       'total_added_with_tax_wall'=>'FormattedTotalAddedWithTaxWall',
                       'total_restincharge_with_tax_wall'=>'FormattedTotalRestInChargeWithTaxWall',
                       'total_added_with_tax_floor'=>'FormattedTotalAddedWithTaxFloor',
                       'total_restincharge_with_tax_floor'=>'FormattedTotalRestInChargeWithTaxFloor',
                       'total_added_with_tax_top'=>'FormattedTotalAddedWithTaxTop',
                       'total_restincharge_with_tax_top'=>'FormattedTotalRestInChargeWithTaxTop',
            
                       'total_added_with_tax'=>'FormattedTotalAddedWithTax',  
                       'total_restincharge_with_tax'=>'FormattedTotalRestInChargeWithTax',  
           
                       'total_sale_and_adder_with_tax'=>'FormattedTotalSaleAndAdderWithTax',
                       'total_sale_and_adder_and_fee_with_tax'=>'FormattedTotalSaleAndAdderAndFeeWithTax',
                       'total_sale_and_adder_tax'=>'FormattedTotalSaleAndAdderTax',
                       'total_sale_and_adder_and_fee_tax'=>'FormattedTotalSaleAndAdderAndFeeTax',
                       'total_sale_and_adder_and_fee_without_tax'=>'FormattedTotalSaleAndAdderAndFeeWithoutTax',
                       'total_prime_and_adder_and_fee_and_restincharge_with_tax'=>'FormattedTotalPrimeAndAdderAndFeeAndRestInChargeWithTax',
                       'rest_to_pay_with_tax'=>'FormattedRestToPayWithTax',
                       'total_sale_and_prime_tax'=>'FormattedTotalSaleAndPrimeWithTax',
                       'advance_tax'=>'FormattedAdvanceWithTax' ,
                       'ana_tax'=>'FormattedAnaTax',
                       'total_sale_and_prime_ana_tax'=>'FormattedTotalSaleAndPrimeAndAnaWithTax',  
                       'ana_pack_tax'=>'FormattedAnaPackTax',
                       'pack_prime'=>'FormattedPackPrime',
                       'total_tax_with_fee'=>'FormattedTotalTaxWithFee',
                       'total_sale_and_prime_and_pack_prime_and_ana_and_ana_pack_tax'=>'FormattedTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTax',
                       'ite_prime'=>'FormattedITEPrime',
                       'number_of_parts'=>'FormattedNumberOfParts',
                       'total_sale_with_ite_prime_and_ana_prime'=>'FormattedTotalSaleWithITEPrimeAndAnaPrime',
                       'total_sale_with_ite_prime'=>'FormattedTotalSaleWithITEPrime',
                       'total_sale_with_pack_prime_and_ana_prime'=>'FormattedTotalSaleWithPackPrimeAndAnaPrime',
                       'total_sale_with_pack_prime'=>'FormattedTotalSaleWithPackPrime',
                       'ana_prime'=>'FormattedAnaPrime',
                       'discount_amount'=>'FormattedDiscountAmount',
                       'rest_in_charge_with_discount_amount'=>'FormattedRestInChargeDiscountAmount',                       
                       'total_sale_and_prime_tax_discount'=>'FormattedTotalSaleAndPrimeTaxAndDiscount',
                    'total_sale_with_pack_prime_discount'=>'FormattedTotalSaleAndPackPrimeAndDiscount',
                    'total_sale_with_ite_prime_discount'=>'FormattedTotalSaleAndItePrimeTaxAndDiscount',
                    'total_sale_and_prime_and_pack_prime_and_ana_and_ana_pack_tax_discount'=>'FormattedTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTaxAndDiscount',
                    'rest_in_charge_discount'=>'FormattedRestInChargeAndDiscount',
                    'total_sale_with_ite_prime_and_ana_prime_discount'=>'FormattedTotalSaleWithITEPrimeAndAnaPrimeAndDiscount',
                    'total_sale_with_tax_discount'=>'FormattedTotalSaleWithTaxAndDiscount',        
                    'total_sale_and_prime_tax_discount'=>'FormattedTotalSaleAndPrimeWithTaxAndDiscount',
                 //   'total_sale_with_pack_prime_discount'=>'FormattedTotalSaleWithPackPrimeAndDiscount',
                    'subvention'=>'FormattedSubvention',
                      'bbc_subvention'=>'FormattedBBcSubvention',
            'cee_prime'=>'FormattedCeePrime',
             'ttc_cee_bbc_passoire_remise'=>'FormattedTotalSaleAndCeeAndBBCAndSubventionWithTaxAndDiscount',
                    'ttc_cee_anah_bbc_passoire_remise'=>'FormattedTotalSaleAndCeeAndAnahBBCAndSubventionWithTaxAndDiscount',
                    'ttc_anah_bbc_passoire_remise'=>'FormattedTotalSaleAndAnahBBCAndSubventionWithTaxAndDiscount'  ,   
                   'passoire_subvention'=>'FormattedPassoireSubvention',
                    'ttc_cee_anah_remise_bbc_passoire'=>'FormattedTotalSaleWithITEPrimeAndAnaPrimeAndDiscountAndBBCAndPassoire',
             'total_sale_and_prime_and_ana_tax_discount'=>'FormattedTotalSaleAndPrimeAndAnaWithTaxAndDiscount',
                    'total_sale_and_pack_prime_and_ana_pack_tax_discount'=>'FormattedTotalSaleAndPackPrimeAndAnaPackWithTaxAndDiscount',
               'total_sale_without_tax_minus_discount_price'=>'FormattedTotalSaleWithoutTaxMinusDiscountPrice',
                    'total_sale_with_tax_minus_discount_price'=>'FormattedTotalSaleWithTaxMinusDiscountPrice',
                    ) as $name=>$method)
        {
            $method='get'.$method;
            $values[$name]=$this->$method();
        }         
        $values['has_prime_one_euro']=$this->hasPrimeOneEuro();
        $values['discount_mode']=$this->get('total_sale_discount_with_tax')!=0.0;
        $values['taxes']=$this->getTaxes()->toArray();        
        if ($this->hasType())
             $values['subvention_type']=$this->getType()->toArray();
        if ($this->hasSignedAt())
            $values['signed_at']=$this->getFormatter()->getSignedAt()->getDateAndTimeFormats();
        return $values;
    }
    
    function getPrime()
    {
        return floatval($this->get('prime'));    
       // $settings=DomoprimeSettings::load($this->getSite());
       // return $this->getTotalSaleWithTax() - $settings->getRestInCharge(); 
    }
    
     function getFixedPrime()
    {
        return floatval($this->get('fixed_prime'));          
    }
    
     function getPackPrime()
    {
        return floatval($this->get('pack_prime'));          
    }
    
     function getAnaPackPrime()
    {
        return floatval($this->get('ana_pack_prime'));          
    }
    
     function getAnaPrime()
    {
        return floatval($this->get('ana_prime'));          
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
    
    function getFormattedPrime()
    {
        return format_currency($this->getPrime(),'EUR'); 
    }        
    
    function getFormattedFixedPrime()
    {
        return format_currency($this->getFixedPrime(),'EUR'); 
    } 
    
    function getFormattedRestInCharge()
    {
        return format_currency($this->getRestInCharge(),'EUR'); 
    }
    
    function getOpcAtForReference($format="Y-m-d")
    {        
        $opc_at=$this->hasContract()?$this->getContract()->get('opc_at'):$this->getMeeting()->get('opc_at'); 
        if (!$opc_at)
            return null;
        $day = new Day($opc_at);   
        return $day->getDate($format);
    }
    
    function getSavAtForReference($format="Y-m-d")
    {
        if ($this->hasContract())    
        {           
            if (!$this->getContract()->get('sav_at'))
                return null;
            $day = new Day($this->getContract()->get('sav_at'));   
            return $day->getDate($format);
        }        
        return null;        
    }
    
    function getFormattedReference()
    {     
        $settings_field=$this->get('mode')=='multiple'?"contract_quotation_reference_format":"quotation_reference_format";
        $parameters=array('{id}'=>$this->get('id'),
                          '{id_work}'=>$this->get('work_id'),
                            '{sav_at}'=>$this->getSavAtForReference("d-m-Y"),
                            '{opc_at}'=>$this->getOpcAtForReference("d-m-Y"));
        
        if (strpos($this->getSettings()->get($settings_field),'{id_company}')!==false)            
           $parameters['{id_company}'] = $this->getNumberOfQuotations() ;         
        return strtr($this->getSettings()->get($settings_field), $parameters);   
    }  
    
    function getFormatter()
    {
        return $this->formatter=$this->formatter===null?new DomoprimeQuotationFormatter($this):$this->formatter;
    }
    
    function hasDatedAt()
    {
        return $this->get('dated_at');
    }
    
    function updateFromMeeting($form,$user)
    { 
        return $this->updateFromContract($form, $user);
    }
    
    function initialize()
    {
        $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('quotation_id'=>$this->get('id')))                       
                         ->setQuery("DELETE FROM ".DomoprimeQuotationProduct::getTable().                                       
                                    " WHERE ".DomoprimeQuotationProduct::getTableField('quotation_id')."='{quotation_id}' ".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite()); 
        
         $this->products=null;
         $this->products_products=null;
        return $this;
    }
    
    function updateFromContract($form,$user)
    {        
        // Remove all products and items
         $this->initialize();
        
        if ($this->getSettings()->hasQuotationEngine())
        {
            
            //echo "===UPDATE====";           
            
            $class=$this->getSettings()->getQuotationEngine();
            if (!class_exists($class))
                throw new mfException(__('Quotation Engine is invalid.'));
           $this->engine=new $class($this);
           $this->engine->update($form,$user);                  
        }  
        else
        {    
            $this->add($form->getValues());            
            $this->products=new DomoprimeQuotationProductCollection(null,$this->getSite());
            foreach ($form->getValue('products') as $value)
            {
               $item=new DomoprimeQuotationProduct(null,$this->getSite());
               $product=$form->getProducts()->getProductById($value['product_id']);
               $item->add(array('product_id'=>$value['product_id'],
                                 'title'=>$product->get('meta_title'),                           
                                 'quotation_id'=>$this,
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

            $this->items=new DomoprimeQuotationProductItemCollection(null,$this->getSite());
            foreach ($form->getValue('products') as $product)
            {            
                foreach ($product['items'] as $value)
                {                                               
                    $work= $form->getProducts()->getProductById($product['product_id']);
                    $item=new  DomoprimeQuotationProductItem(null,$this->getSite());
                    $item->add(array('quotation_id'=>$this,
                                     'quantity'=>$product['quantity'],
                                     'quotation_product_id'=>$this->products[$product['product_id']],
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
            $this->set('prime',$this->getTotalSaleWithTax() - $this->getSettings()->getRestInCharge());
            $this->set('creator_id',$user);
            $this->save();               
        }
        return $this;
    }
    
    
    function setIsSigned()
    {
        $this->set('is_signed','YES');
        return $this->save();
    }
    
    function isSigned()
    {
        return $this->get('is_signed')=='YES';
    }
    
   /* static function getNumberOfQuotationsByMeeting()
    {
        if ($this->isNotLoaded())
            return false;
        if ($this->number_of_quotations_by_meeting===null)
        {
             $db=mfSiteDatabase::getInstance()
                     ->setParameters(array('meeting_id'=>$this->get('meeting_id')))
                     ->setQuery("SELECT count(id) FROM ".self::getTable()." WHERE meeting_id='{meeting_id}';")
                     ->makeSiteSqlQuery($this->site);                                          
             $row=$db->fetchRow();
             $this->number_of_quotations_by_meeting=$row[0];                   
        }    
        return $this->number_of_quotations_by_meeting;
    }*/
    
    
    static function loadNumberOfQuotationsForContract(CustomerContract $contract)
    {        
        if ($contract->isNotLoaded())
            return false;
        if ($contract->quotations===null)
        {
             $db=mfSiteDatabase::getInstance()
                     ->setParameters(array('meeting_id'=>$contract->getMeeting()->get('id')))
                     ->setQuery("SELECT count(id) FROM ".self::getTable()." WHERE meeting_id='{meeting_id}';")
                     ->makeSiteSqlQuery($contract->getSite());           
             $row=$db->fetchRow();
             $contract->quotations=($row[0] > 0);  
            // var_dump($contract->getQuotations());
        }            
    }
    
    static function loadNumberOfQuotationsForMeeting(CustomerContract $meeting)
    {        
        if ($meeting->isNotLoaded())
            return false;
        if ($meeting->quotations===null)
        {
             $db=mfSiteDatabase::getInstance()
                     ->setParameters(array('meeting_id'=>$meeting->get('id')))
                     ->setQuery("SELECT count(id) FROM ".self::getTable()." WHERE meeting_id='{meeting_id}';")
                     ->makeSiteSqlQuery($meeting->getSite());                                          
             $row=$db->fetchRow();
             $meeting->quotations=($row[0] > 0);                
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
    
    
    static function checkIfContractsWithQuotationFromSelection(mfArray $selection,$site=null)
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
        $query->select("count(DISTINCT(".DomoprimeQuotation::getTableField('contract_id').")) as `number_of_operations`")
              ->select(DomoprimeQuotationProduct::getTableField('product_id'))
              ->from(DomoprimeQuotation::getTable())
              ->inner(DomoprimeQuotationProduct::getInnerForJoin('quotation_id'))
              ->inner(DomoprimeQuotation::getOuterForJoin('customer_id'))
              ->inner(DomoprimeQuotation::getOuterForJoin('contract_id'))
              ->where(DomoprimeQuotation::getTableField('is_signed')."='YES'")
              ->where($filter->getWhere())
              ->groupBy(DomoprimeQuotationProduct::getTableField('product_id'))              
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
    
    
    static function getNumberOfSurfacesSignedQuotationsFromFilter($filter)
    {
        $collection=new DomoprimeSurfaceCollection();
        $query=new mfQuery();
        $query->select("sum(".DomoprimeQuotationProduct::getTableField('quantity').") as `number_of_surfaces`")
              ->select(DomoprimeQuotationProduct::getTableField('product_id'))
              ->from(DomoprimeQuotation::getTable())
              ->inner(DomoprimeQuotationProduct::getInnerForJoin('quotation_id'))
              ->inner(DomoprimeQuotation::getOuterForJoin('customer_id'))
              ->inner(DomoprimeQuotation::getOuterForJoin('contract_id'))
              ->where(DomoprimeQuotation::getTableField('is_signed')."='YES'")
              ->where($filter->getWhere())
              ->groupBy(DomoprimeQuotationProduct::getTableField('product_id'))              
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
    
    
     static function getNumberOfOperationsQuotationsFromFilter($filter)
    {       
        $collection=new DomoprimeOperationCollection();
        $query=new mfQuery();
        $query->select("count(DISTINCT(".DomoprimeQuotation::getTableField('contract_id').")) as `number_of_operations`")
              ->select(DomoprimeQuotationProduct::getTableField('product_id'))
              ->from(DomoprimeQuotation::getTable())
              ->inner(DomoprimeQuotationProduct::getInnerForJoin('quotation_id'))
              ->inner(DomoprimeQuotation::getOuterForJoin('customer_id'))
              ->inner(DomoprimeQuotation::getOuterForJoin('contract_id'))             
              ->where($filter->getWhere())
              ->groupBy(DomoprimeQuotationProduct::getTableField('product_id'))              
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
    
    
    static function getNumberOfSurfacesQuotationsFromFilter($filter)
    {
        $collection=new DomoprimeSurfaceCollection();
        $query=new mfQuery();
        $query->select("sum(".DomoprimeQuotationProduct::getTableField('quantity').") as `number_of_surfaces`")
              ->select(DomoprimeQuotationProduct::getTableField('product_id'))
              ->from(DomoprimeQuotation::getTable())
              ->inner(DomoprimeQuotationProduct::getInnerForJoin('quotation_id'))
              ->inner(DomoprimeQuotation::getOuterForJoin('customer_id'))
              ->inner(DomoprimeQuotation::getOuterForJoin('contract_id'))             
              ->where($filter->getWhere())
              ->groupBy(DomoprimeQuotationProduct::getTableField('product_id'))              
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
    
    static function getNumberOfContractsQuotationsFromFilter($filter)
    {
        $collection=new DomoprimeOperationCollection();
        $query=new mfQuery();
        $query->select("count(DISTINCT(".DomoprimeQuotation::getTableField('contract_id').")) as `number_of_contracts`")
              ->select(DomoprimeQuotationProduct::getTableField('product_id'))
              ->from(DomoprimeQuotation::getTable())
              ->inner(DomoprimeQuotationProduct::getInnerForJoin('quotation_id'))
              ->inner(DomoprimeQuotation::getOuterForJoin('customer_id'))
              ->inner(DomoprimeQuotation::getOuterForJoin('contract_id'))             
              ->where($filter->getWhere())
            //  ->groupBy(DomoprimeQuotation::getTableField('contract_id'))              
              ->groupBy(DomoprimeQuotationProduct::getTableField('product_id'))              
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
    
    
    function getName()
    {
        return __("quotation")."_".$this->get('reference')."_".$this->get('id').".pdf";       
    }
    
    function getFilenameForPdf()
    {
        return  mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/data/domoprime/quotations/".$this->get('id')."/".$this->getName();       
    }
    
    
    function getPdfFile()
    {
       if ($this->file_pdf===null)
       {
          $this->file_pdf=new File($this->getFilenameForPdf()) ;
       }    
       return $this->file_pdf;
    }
    
    function toArrayForPdf()
    {
        $values=parent::toArray(array());       
        foreach (array(                       
                       'total_sale_with_tax'=>'FormattedTotalSaleWithTax',
                       'total_sale_without_tax'=>'FormattedTotalSaleWithoutTax',
                       'total_tax'=>'FormattedTotalSaleTax',
                       'prime'=>'FormattedPrime',
                       'fixed_prime'=>'FormattedFixedPrime',
                       'tax_credit'=>'FormattedTaxCreditUsed',
                       'tax_credit_used'=>'FormattedTaxCredit',
                       'rest_in_charge'=>'FormattedTaxCredit',
                       'tax_credit_limit'=>'FormattedTaxCreditLimit',
                       'number_of_people'=>'FormattedNumberOfPeople',
                       'number_of_children'=>'FormattedNumberOfChildren',
                       'rest_in_charge_after_credit'=>'FormattedRestInChargeAfterCredit',
                       'reference'=>'FormattedReference',   
                       'tax_credit_available'=>'FormattedTaxCreditAvailable',
                       'prime_oneeuro'=>'FormattedCurrencyPrimeOneEuro',
                       'prime_one_euro'=>'FormattedPrimeOneEuro',  
                       'prime_rounded_one_euro'=>'FormattedRoundedPrimeOneEuro',
                       'fee_file'=>'FormattedFeeFile',
                       'fee_file_without_tax'=>'FormattedFeeFileWithoutTax',
                       'total_sale_with_tax_and_fee'=>'FormattedTotalPriceWithTaxAndFeeFile',
                       'total_sale_without_tax_and_fee'=>'FormattedTotalPriceWithoutTaxAndFeeFile',                      
                       'tax_fee_file_eur'=>'FormattedTaxFeeFile',
                       'tax_fee_file'=>'TaxFeeFile',
                       'total_tax'=>'FormattedTotalTax',
                       'total_sale_with_tax_minus_fee'=>'FormattedTotalPriceWithTaxMinusFeeFile',
                       'total_sale_without_tax_minus_fee'=>'FormattedTotalPriceWithoutTaxMinusFeeFile',
                       'total_sale_discount_with_tax'=>'FormattedTotalSaleDiscountWithTax',
                       'total_sale_discount_without_tax'=>'FormattedTotalSaleDiscountWithoutTax',
                       'total_discount_tax'=>'FormattedTotalSaleDiscountTax',                        
                       'total_sale_discount_with_tax_minus_fee'=>'FormattedTotalDiscountPriceWithTaxMinusFeeFile',
                       'total_sale_without_tax_minus_fee'=>'FormattedTotalDiscountPriceWithoutTaxMinusFeeFile',
                       'total_gross_sale_with_tax'=>'FormattedTotalGrossSaleWithTax',
                       'total_gross_sale_without_tax'=>'FormattedTotalGrossSaleWithoutTax',
                       'total_gross_tax'=>'FormattedTotalGrossTax',
                       'total_gross_tax_with_fee'=>'FormattedTotalGrossTaxWithFeeFile',
                       'total_fee_file_without_tax'=>'FormattedTotalFeeFileWithoutTax',
                       'total_gross_sale_fee_file_without_tax'=>'FormattedTotalGrossSaleAndFeeFileWithoutTax',
                       'fee_file_tax_rate'=>'FormattedFeefileTaxRate',
                        'total_gross_sale_fee_file_with_tax'=>'FormattedTotalGrossSaleAndFeeWithTax',
                        'total_gross_sale_fee_file_minus_prime_with_tax'=>'FormattedTotalGrossSaleAndFeeMinusPrimeWithTax',
                    
                       'total_sale_101_with_tax'=>'FormattedTotalSale101WithTax',
                       'total_sale_101_without_tax'=>'FormattedTotalSale101WithoutTax',            
                       'total_sale_102_with_tax'=>'FormattedTotalSale102WithTax',
                       'total_sale_102_without_tax'=>'FormattedTotalSale102WithoutTax',            
                       'total_sale_103_with_tax'=>'FormattedTotalSale103WithTax',
                       'total_sale_103_without_tax'=>'FormattedTotalSale103WithoutTax',
            
                       'global_sale_with_tax'=>'FormattedGlobalSaleWithTax',
                       'global_sale_without_tax'=>'FormattedGlobalSaleWithoutTax',    
            
                       'total_added_with_tax_wall'=>'FormattedTotalAddedWithTaxWall',
                       'total_restincharge_with_tax_wall'=>'FormattedTotalRestInChargeWithTaxWall',
                       'total_added_with_tax_floor'=>'FormattedTotalAddedWithTaxFloor',
                       'total_restincharge_with_tax_floor'=>'FormattedTotalRestInChargeWithTaxFloor',
                       'total_added_with_tax_top'=>'FormattedTotalAddedWithTaxTop',
                       'total_restincharge_with_tax_top'=>'FormattedTotalRestInChargeWithTaxTop',
            
                       'total_added_with_tax'=>'FormattedTotalAddedWithTax',  
                       'total_restincharge_with_tax'=>'FormattedTotalRestInChargeWithTax',  
            
                       'total_sale_and_adder_with_tax'=>'FormattedTotalSaleAndAdderWithTax',
                       'total_sale_and_adder_and_fee_with_tax'=>'FormattedTotalSaleAndAdderAndFeeWithTax',
                       'total_sale_and_adder_tax'=>'FormattedTotalSaleAndAdderTax',
                       'total_sale_and_adder_and_fee_tax'=>'FormattedTotalSaleAndAdderAndFeeTax',
                       'total_sale_and_adder_and_fee_without_tax'=>'FormattedTotalSaleAndAdderAndFeeWithoutTax',
                       'total_prime_and_adder_and_fee_and_restincharge_with_tax'=>'FormattedTotalPrimeAndAdderAndFeeAndRestInChargeWithTax',
                       'rest_to_pay_with_tax'=>'FormattedRestToPayWithTax',
                       'total_tax_with_fee'=>'FormattedTotalTaxWithFee',
                       'total_sale_and_prime_tax'=>'FormattedTotalSaleAndPrimeWithTax',
                       'advance_tax'=>'FormattedAdvanceWithTax' ,
                       'ana_tax'=>'FormattedAnaTax',
                       'total_sale_and_prime_ana_tax'=>'FormattedTotalSaleAndPrimeAndAnaWithTax',   
                       'ana_pack_tax'=>'FormattedAnaPackTax',
                       'pack_prime'=>'FormattedPackPrime',
                       'total_sale_and_prime_and_pack_prime_and_ana_and_ana_pack_tax'=>'FormattedTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTax',
                       'ite_prime'=>'FormattedITEPrime',
                       'number_of_parts'=>'FormattedNumberOfParts',
                       'total_sale_with_ite_prime_and_ana_prime'=>'FormattedTotalSaleWithITEPrimeAndAnaPrime',
                       'total_sale_with_ite_prime'=>'FormattedTotalSaleWithITEPrime',
                       'total_sale_with_pack_prime_and_ana_prime'=>'FormattedTotalSaleWithPackPrimeAndAnaPrime',
                       'total_sale_with_pack_prime'=>'FormattedTotalSaleWithPackPrime',
                       'ana_prime'=>'FormattedAnaPrime',     
                       'discount_amount'=>'FormattedDiscountAmount',
                       'rest_in_charge_with_discount_amount'=>'FormattedRestInChargeDiscountAmount',
                       'total_sale_and_prime_tax_discount'=>'FormattedTotalSaleAndPrimeTaxAndDiscount',
                    'total_sale_with_pack_prime_discount'=>'FormattedTotalSaleAndPackPrimeAndDiscount',
                    'total_sale_with_ite_prime_discount'=>'FormattedTotalSaleAndItePrimeTaxAndDiscount',
                    'total_sale_and_prime_and_pack_prime_and_ana_and_ana_pack_tax_discount'=>'FormattedTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTaxAndDiscount',
                    'rest_in_charge_discount'=>'FormattedRestInChargeAndDiscount',
                    'total_sale_with_ite_prime_and_ana_prime_discount'=>'FormattedTotalSaleWithITEPrimeAndAnaPrimeAndDiscount',
                    'total_sale_with_tax_discount'=>'FormattedTotalSaleWithTaxAndDiscount',        
                    'total_sale_and_prime_tax_discount'=>'FormattedTotalSaleAndPrimeWithTaxAndDiscount',
                 //   'total_sale_with_pack_prime_discount'=>'FormattedTotalSaleWithPackPrimeAndDiscount',
                    'subvention'=>'FormattedSubvention',
                    'bbc_subvention'=>'FormattedBBcSubvention',                  
                    'cee_prime'=>'FormattedCeePrime',
                    'ttc_cee_bbc_passoire_remise'=>'FormattedTotalSaleAndCeeAndBBCAndSubventionWithTaxAndDiscount',
                    'ttc_cee_anah_bbc_passoire_remise'=>'FormattedTotalSaleAndCeeAndAnahBBCAndSubventionWithTaxAndDiscount',
                    'ttc_anah_bbc_passoire_remise'=>'FormattedTotalSaleAndAnahBBCAndSubventionWithTaxAndDiscount'    ,
                    'passoire_subvention'=>'FormattedPassoireSubvention',
                    'ttc_cee_anah_remise_bbc_passoire'=>'FormattedTotalSaleWithITEPrimeAndAnaPrimeAndDiscountAndBBCAndPassoire',
            
                    'total_sale_and_prime_and_ana_tax_discount'=>'FormattedTotalSaleAndPrimeAndAnaWithTaxAndDiscount',
                    'total_sale_and_pack_prime_and_ana_pack_tax_discount'=>'FormattedTotalSaleAndPackPrimeAndAnaPackWithTaxAndDiscount',
                    'total_sale_without_tax_minus_discount_price'=>'FormattedTotalSaleWithoutTaxMinusDiscountPrice',
                    'total_sale_with_tax_minus_discount_price'=>'FormattedTotalSaleWithTaxMinusDiscountPrice',                   
                    ) as $name=>$method)
        {
            $method='get'.$method;
            $values[$name]=$this->$method();
        }     
        $values['has_prime_one_euro']=$this->hasPrimeOneEuro();
        $values['discount_mode']=$this->get('total_sale_discount_with_tax')!=0.0;
        $values['taxes']=$this->getTaxes()->toArray();     
         if ($this->hasType())
             $values['subvention_type']=$this->getType()->toArray();
         if ($this->hasSignedAt())
            $values['signed_at']=$this->getFormatter()->getSignedAt()->getDateAndTimeFormats();
        return $values;
    }
    
     function updateLastFromWork()
    {
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('work_id'=>$this->get('work_id'),'id'=>$this->get('id')))               
                ->setQuery("UPDATE ".self::getTable()." SET is_last='NO' WHERE mode='simple' AND  work_id='{work_id}' AND id!='{id}'".
                           ";")               
                ->makeSqlQuery();
        return $this;
    }
    
    function updateLastFromContract()
    {
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('contract_id'=>$this->get('contract_id'),'id'=>$this->get('id')))               
                ->setQuery("UPDATE ".self::getTable()." SET is_last='NO' WHERE mode='simple' AND contract_id='{contract_id}' AND id!='{id}'".
                           ";")               
                ->makeSqlQuery();
        return $this;
    }
    
    function updateLastFromMeeting()
    {
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('meeting_id'=>$this->get('meeting_id'),'id'=>$this->get('id')))               
                ->setQuery("UPDATE ".self::getTable()." SET is_last='NO' WHERE mode='simple' AND  meeting_id='{meeting_id}' AND id!='{id}'".
                           ";")               
                ->makeSqlQuery();        
        return $this; 
    }
    
    
    static function setContractForQuotationsFromMeeting(CustomerContract $contract)
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
    
    function getEngine()
    {
        return $this->engine;
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
        return floatval($this->get('tax_credit_available')); 
    }
    
    function getFormattedTaxCreditAvailable()
    {
        return format_currency($this->getTaxCreditAvailable(),"EUR");
    }
       
    function getRoundedPrimeOneEuro()
    {
        return $this->getTotalSaleWithTax() - $this->getSettings()->getRestInCharge() - $this->getFixedPrime();
    }  
    
      function getPrimeOneEuro()
    {
        return $this->getTotalSaleWithTax() - $this->getSettings()->getRestInCharge() - $this->getFixedPrime();
    }    
    
    function getFormattedCurrencyPrimeOneEuro()
    {
        return format_currency($this->getPrimeOneEuro(),'EUR');
    }
    
     function getFormattedPrimeOneEuro()
    {
        return format_number($this->getPrimeOneEuro(),'#.00');
    }
    
     function getFormattedRoundedPrimeOneEuro()
    {
        return format_number($this->getPrimeOneEuro(),'#.00');
    }
    
    function isOwner()
    {
         $user=mfContext::getInstance()->getUser();           
         if ($this->hasContract())
         {                
             return $this->getContract()->isOwner();                  
         }   
         if ($this->hasMeeting())
         {    
             return $this->getMeeting()->isOwner();                  
         }  
         return false;
    }
    
    function getFeeFile()
    {
         return 1.0;       
    }
    
    function getFeeFileWithoutTax()
    {
         return 0.83;
    }
    
      function getTotalTaxFeeFile()
    {
        return 0.17; 
    }
    
      function getFormattedFeeFile()
    {
        return format_currency($this->getFeeFile(),'EUR'); 
    } 
    
      function getFormattedFeeFileWithoutTax()
    {
        return format_currency($this->getFeeFileWithoutTax(),'EUR'); 
    } 
    
    function getFormattedTotalPriceWithTaxAndFeeFile()
    {
        return  format_currency($this->getTotalPriceWithTaxAndFeeFile(),'EUR'); 
    }
    
    function getTotalPriceWithTaxAndFeeFile()
    {
        return  $this->getTotalSaleWithTax() + $this->getFeeFile();
    }
    
     function getFormattedTotalPriceWithoutTaxAndFeeFile()
    {
        return  format_currency($this->getTotalPriceWithoutTaxAndFeeFile(),'EUR'); 
    }
    
    function getTotalPriceWithoutTaxAndFeeFile()
    {
        return  $this->getTotalSaleWithoutTax() + $this->getFeeFileWithoutTax();
    }      
    
    function getTotalFeeFileWithoutTax()
    {
        return  $this->getFeeFile() - $this->getTotalTaxFeeFile();
    }
    
    function getTaxFeeFile()
    {
        return  format_number($this->getTotalTaxFeeFile(),"#.00");
    }
    
    function getFormattedTaxFeeFile()
    {
        return  format_currency($this->getTotalTaxFeeFile(),"EUR");
    }
    
    function getFormattedTotalFeeFileWithoutTax()
    {
        return  format_currency($this->getTotalFeeFileWithoutTax(),"EUR");
    }
    
    function getFormattedTotalPriceWithTaxMinusFeeFile()
    {
        return  format_currency($this->getTotalSaleWithTax() - $this->getFeeFile(),'EUR');
    }
    
    function getFormattedTotalPriceWithoutTaxMinusFeeFile()
    {
        return format_currency($this->getTotalSaleWithoutTax() - $this->getFeeFileWithoutTax(),'EUR');
    }
    
    function getFormattedTotalTax()
    {        
        return format_currency($this->getTotalSaleWithTax() - $this->getTotalSaleWithoutTax(),'EUR');
    }  
    
    function getFormattedTotalTaxWithFee()
    {        
        return format_currency($this->getTotalSaleWithTax() - $this->getTotalSaleWithoutTax() + $this->getFeeFileWithoutTax(),'EUR');
    }          
         
     function getTotalSaleDiscountWithoutTax()
    {
        return floatval($this->get('total_sale_discount_without_tax'));                                  
    }
    
    function getFormattedTotalSaleDiscountWithoutTax()
    {
        return format_currency($this->getTotalSaleDiscountWithoutTax(),'EUR');
    }
    
    function getTotalSaleDiscountWithTax()
    {       
        return floatval($this->get('total_sale_discount_with_tax'));                                   
    }
    
    function getFormattedTotalSaleDiscountWithTax()
    {
        return format_currency($this->getTotalSaleDiscountWithTax(),'EUR');
    }
    
    
     function getTotalSaleDiscountTax()
    {
        return $this->getTotalSaleDiscountWithTax() - $this->getTotalSaleDiscountWithoutTax();                                  
    }
    
    function getFormattedTotalSaleDiscountTax()
    {
        return format_currency($this->getTotalSaleDiscountTax(),'EUR');
    }
    
    /* */
    function getFormattedTotalDiscountPriceWithTaxMinusFeeFile()
    {
        return  format_currency($this->getTotalSaleDiscountWithTax() - $this->getFeeFile(),'EUR');
    }
    
    function getFormattedTotalDiscountPriceWithoutTaxMinusFeeFile()
    {
        return format_currency($this->getTotalSaleDiscountWithoutTax() - $this->getFeeFileWithoutTax(),'EUR');
    }
    
    function getFormattedDiscountTotalTax()
    {
        return format_currency($this->getTotalSaleDiscountWithTax() - $this->getTotalSaleDiscountWithoutTax() + $this->getFeeFileWithoutTax() * $this->getSettings()->get('tax_fee_file','0.2'),'EUR'); 
    }
    
    
    function getTotalGrossSaleWithTax()
    {       
       return  $this->getTotalSaleWithTax() - $this->getTotalSaleDiscountWithTax();
    }
    
    function getFormattedTotalGrossSaleWithTax()
    {
       return format_currency($this->getTotalGrossSaleWithTax(),'EUR');
    }
    
    function getTotalGrossSaleWithoutTax()
    {
       return   $this->getTotalSaleWithoutTax() - $this->getTotalSaleDiscountWithoutTax();
    }        
    
    function getFormattedTotalGrossSaleWithoutTax()
    {
       return format_currency($this->getTotalGrossSaleWithoutTax(),'EUR');
    }
    
    function getTotalGrossTax()
    {        
       return  $this->getTotalGrossSaleWithTax() -   $this->getTotalGrossSaleWithoutTax();
    }
   
     function getFormattedTotalGrossTax()
    {      
       return format_currency($this->getTotalGrossTax(),'EUR');
    }
    
    function getTotalGrossTaxWithFeeFile()
    {
       return $this->getTotalTaxFeeFile() + ($this->getTotalSaleWithTax()  -  $this->getTotalSaleWithoutTax()) - ($this->getTotalSaleDiscountWithTax()  -  $this->getTotalSaleDiscountWithoutTax());
    }
    
     function getFormattedTotalGrossTaxWithFeeFile()
    {
       return format_currency($this->getTotalGrossTaxWithFeeFile(),'EUR');
    }
    
    
    function getTotalGrossSaleAndFeeFileWithoutTax()
    {
       return $this->getTotalSaleWithoutTax() - $this->getTotalSaleDiscountWithoutTax() + $this->getTotalFeeFileWithoutTax();
    }
    
    function getFormattedTotalGrossSaleAndFeeFileWithoutTax()
    {
       return format_currency($this->getTotalGrossSaleAndFeeFileWithoutTax(),'EUR');
    }
    
    function getFormattedFeefileTaxRate()
    {
        return format_pourcentage($this->getSettings()->get('tax_fee_file'));
    }
    
    function getTotalGrossSaleAndFeeWithTax()
    {
       return $this->getTotalGrossSaleWithTax()+ $this->getFeeFile(); 
    }
    
    function getFormattedTotalGrossSaleAndFeeWithTax()
    {
        return format_currency($this->getTotalGrossSaleAndFeeWithTax(),"EUR");
    }
    
     function getTotalGrossSaleAndFeeMinusPrimeWithTax()
    {
        return $this->getTotalGrossSaleWithTax()+ $this->getFeeFile() - $this->getSettings()->getRestInCharge();
    }
    
    function getFormattedTotalGrossSaleAndFeeMinusPrimeWithTax()
    {
        return format_currency($this->getTotalGrossSaleAndFeeMinusPrimeWithTax(),"EUR");
    }
    
    
    
    function createFromItemsAndContract(CustomerContract $contract,$user)
    {
        $request= new DomoprimeCustomerRequest($contract,$this->getSite());       
        if (!$request->hasSurfaces())
             throw new mfException(__("No surface exists"));  
        if ($contract->getProductItemsWithProductAndItem()->isEmpty())
             throw new mfException(__("No item affected.")); 
        $contract->set('is_signed','NO')->save();
        $this->set('month',$contract->hasQuotedAt()?$contract->getQuotedAtDate()->getMonth():date('m'));
        $this->set('year',$contract->hasQuotedAt()?$contract->getQuotedAtDate()->getYear():date('Y'));        
        $this->set('contract_id',$contract);      
        $this->set('company_id',$contract->get('company_id'));      
        $this->set('meeting_id',$contract->hasMeeting() && $contract->getMeeting()->isLoaded()?$contract->getMeeting():null);      
        $this->set('dated_at',$contract->hasQuotedAt()?$contract->get('quoted_at'):date("Y-m-d"));
        $this->set('customer_id',$contract->getCustomer());   
        $this->set('creator_id',$user);
        $this->save();
        $this->updateLastFromContract(); 
        
        if ($this->getSettings()->hasQuotationEngine())
        {
            //echo "====CREATION=====";
            $class=$this->getSettings()->getQuotationEngine();          
            if (!class_exists($class))
                throw new mfException(__('Quotation Engine is invalid.'));
            $this->engine=new $class($this);
            $this->engine->createFromItemsAndRequest($request,$user);          
        }  
        else
        {   
        $this->set('reference',$this->getFormattedReference());
        $this->products=new DomoprimeQuotationProductCollection(null,$this->getSite());                    
        foreach ($contract->getProductItemsWithProductAndItem() as $item)
        {
           // var_dump($request->getQuantityByProduct($item->getProduct()));
               $product=new DomoprimeQuotationProduct(null,$this->getSite());                
               $product->set('quotation_id',$this);
               $product->set('title',$item->getProduct()->get('meta_title'));
               $product->set('product_id',$item->getProduct());
               $product->set('contract_id',$contract);
               $product->set('tva_id',$item->getProduct()->get('tva_id'));
               $product->set('quantity',$request->getQuantityByProduct($item->getProduct()));
               $product->set('meeting_id',$contract->hasMeeting()?$contract->getMeeting():null);
               $product->set('purchase_price_without_tax',$item->getProduct()->getPurchasePriceWithoutTax());
               $product->set('purchase_price_with_tax',$item->getProduct()->getPurchasePriceWithTax());
               $product->set('sale_price_without_tax',$item->getProduct()->getSalePriceWithoutTax());
               $product->set('sale_price_with_tax',$item->getProduct()->getSalePriceWithTax());
               $product->set('total_purchase_price_with_tax',$item->getProduct()->getPurchasePriceWithTax() * $request->getQuantityByProduct($item->getProduct()));
               $product->set('total_sale_price_with_tax',$item->getProduct()->getSalePriceWithTax() * $request->getQuantityByProduct($item->getProduct()));
               $product->set('total_purchase_price_without_tax',$item->getProduct()->getPurchasePriceWithoutTax() * $request->getQuantityByProduct($item->getProduct()));
               $product->set('total_sale_price_without_tax',$item->getProduct()->getSalePriceWithoutTax() * $request->getQuantityByProduct($item->getProduct()));  
               $this->products[$item->getProduct()->get('id')]=$product;
        }      
        $this->products->save();
        $this->items=new DomoprimeQuotationProductItemCollection(null,$this->getSite());
        foreach ($contract->getProductItemsWithProductAndItem() as $item)
        {
               $product_item=new DomoprimeQuotationProductItem(null,$this->getSite());                
               $product_item->set('quotation_id',$this);
               $product_item->set('quotation_product_id',$this->products[$item->getProduct()->get('id')]);
               $product_item->set('product_id',$item->getItem()->get('product_id'));
               $product_item->set('item_id',$item->getItem());
               $product_item->set('quantity',$request->getQuantityByProduct($item->getProduct()));
               $product_item->set('tva_id',$item->get('tva_id'));
               $product_item->set('meeting_id',$contract->hasMeeting()?$contract->getMeeting():null);
               $product_item->set('purchase_price_without_tax',$item->getItem()->getPurchasePriceWithoutTax());
               $product_item->set('purchase_price_with_tax',$item->getItem()->getPurchasePriceWithTax());
               $product_item->set('sale_price_without_tax',$item->getItem()->getSalePriceWithoutTax());
               $product_item->set('sale_price_with_tax',$item->getItem()->getSalePriceWithTax());
               $product_item->set('total_purchase_price_with_tax',$item->getItem()->getPurchasePriceWithTax() * $request->getQuantityByProduct($item->getProduct()));
               $product_item->set('total_sale_price_with_tax',$item->getItem()->getSalePriceWithTax() * $request->getQuantityByProduct($item->getProduct()));
               $product_item->set('total_purchase_price_without_tax',$item->getItem()->getPurchasePriceWithoutTax() * $request->getQuantityByProduct($item->getProduct()));
               $product_item->set('total_sale_price_without_tax',$item->getItem()->getSalePriceWithoutTax() * $request->getQuantityByProduct($item->getProduct()));  
               $this->items[]=$product_item;
        } 
        $this->items->save();
        
        $this->set('total_sale_without_tax',$this->items->getTotalSaleWithoutTax());
        $this->set('total_sale_with_tax',$this->items->getTotalSaleWithTax());
        $this->set('total_purchase_without_tax',$this->items->getTotalPurchaseWithoutTax());
        $this->set('total_purchase_with_tax',$this->items->getTotalPurchaseWithTax());
        $this->set('total_tax',$this->items->getTotalTax());
        $this->set('prime',$this->items->getTotalSaleWithTax() - $this->getSettings()->getRestInCharge());        
        $this->set('creator_id',$user);
        $this->save();
        }
        return $this;
    }
    
    
     function getSignedAt()
     {
         return new DayTime($this->get('signed_at'));
     }
     
     
    function getTotalSale101WithTax()
    {       
        return floatval($this->get('total_sale_101_with_tax'));                                   
    }
    
    function getFormattedTotalSale101WithTax()
    {
        return format_currency($this->getTotalSale101WithTax(),'EUR');
    }
    
    function getTotalSale102WithTax()
    {       
        return floatval($this->get('total_sale_102_with_tax'));                                   
    }
    
    function getFormattedTotalSale102WithTax()
    {
        return format_currency($this->getTotalSale102WithTax(),'EUR');
    }
    
    function getTotalSale103WithTax()
    {       
        return floatval($this->get('total_sale_103_with_tax'));                                   
    }
    
    function getFormattedTotalSale103WithTax()
    {
        return format_currency($this->getTotalSale103WithTax(),'EUR');
    }
    
    function getTotalSale101WithoutTax()
    {       
        return floatval($this->get('total_sale_101_without_tax'));                                   
    }
    
    function getFormattedTotalSale101WithoutTax()
    {
        return format_currency($this->getTotalSale101WithoutTax(),'EUR');
    }
    
    function getTotalSale102WithoutTax()
    {       
        return floatval($this->get('total_sale_102_without_tax'));                                   
    }
    
    function getFormattedTotalSale102WithoutTax()
    {
        return format_currency($this->getTotalSale102WithoutTax(),'EUR');
    }
    
    function getTotalSale103WithoutTax()
    {       
        return floatval($this->get('total_sale_103_without_tax'));                                   
    }
    
    function getFormattedTotalSale103WithoutTax()
    {
        return format_currency($this->getTotalSale103WithoutTax(),'EUR');
    }
   
    function getGlobalSaleWithTax()
    {
        return $this->getTotalSale101WithTax() + $this->getTotalSale102WithTax() + $this->getTotalSale103WithTax();
    }
    
     function getGlobalSaleWithoutTax()
    {
        return $this->getTotalSale101WithoutTax() + $this->getTotalSale102WithoutTax() + $this->getTotalSale103WithoutTax();
    }
    
     function getFormattedGlobalSaleWithTax()
    {
        return format_currency($this->getGlobalSaleWithTax(),'EUR');
    }
    
     function getFormattedGlobalSaleWithoutTax()
    {
        return format_currency($this->getGlobalSaleWithoutTax(),'EUR');
    }
    
    /* =========================================================================== */
    
    function getTotalAddedWithTaxWall()
    {
        return floatval($this->get('total_added_with_tax_wall'));
    }
    
      function getFormattedTotalAddedWithTaxWall()
    {
        return format_currency($this->getTotalAddedWithTaxWall(),'EUR');
    }
    
     function getTotalAddedWithTaxFloor()
    {
        return floatval($this->get('total_added_with_tax_floor'));
    }
    
      function getFormattedTotalAddedWithTaxFloor()
    {
        return format_currency($this->getTotalAddedWithTaxFloor(),'EUR');
    }
    
     function getTotalAddedWithTaxTop()
    {
        return floatval($this->get('total_added_with_tax_top'));
    }
    
      function getFormattedTotalAddedWithTaxTop()
    {
        return format_currency($this->getTotalAddedWithTaxTop(),'EUR');
    } 
    
     function getTotalAddedWithTax()
    {
        return $this->getTotalAddedWithTaxTop() + $this->getTotalAddedWithTaxWall() + $this->getTotalAddedWithTaxFloor();
    }
    
     function getFormattedTotalAddedWithTax()
    {
        return format_currency($this-> getTotalAddedWithTax(),'EUR');
    } 
    
    /* =========================================================================== */
    
    function getTotalRestInChargeWithTaxWall()
    {
        return floatval($this->get('total_restincharge_with_tax_wall'));
    }
    
      function getFormattedTotalRestInChargeWithTaxWall()
    {
        return format_currency($this->getTotalRestInChargeWithTaxWall(),'EUR');
    }
    
     function getTotalRestInChargeWithTaxFloor()
    {
        return floatval($this->get('total_restincharge_with_tax_floor'));
    }
    
      function getFormattedTotalRestInChargeWithTaxFloor()
    {
        return format_currency($this->getTotalRestInChargeWithTaxFloor(),'EUR');
    }
    
     function getTotalRestInChargeWithTaxTop()
    {
        return floatval($this->get('total_restincharge_with_tax_top'));
    }
    
      function getFormattedTotalRestInChargeWithTaxTop()
    {
        return format_currency($this->getTotalRestInChargeWithTaxTop(),'EUR');
    } 
    
    
    function getTotalRestInChargeWithTax()
    {
        return $this->getTotalRestInChargeWithTaxTop() + $this->getTotalRestInChargeWithTaxWall() + $this->getTotalRestInChargeWithTaxFloor();
    }
    
     function getFormattedTotalRestInChargeWithTax()
    {
        return format_currency($this->getTotalRestInChargeWithTax(),'EUR');
    } 
    
    function getTotalSaleAndAdderWithTax()
    {
        return $this->getTotalSaleWithTax() + $this->getTotalAddedWithTax();                                
    }
    
    function getFormattedTotalSaleAndAdderWithTax()
    {
        return format_currency($this->getTotalSaleAndAdderWithTax(),'EUR');
    } 
    
      function getTotalSaleAndAdderAndFeeWithTax()
    {
        return $this->getTotalSaleAndAdderWithTax() +  $this->getFeeFile();                                
    }
    
     function getFormattedTotalSaleAndAdderAndFeeWithTax()
    {
        return format_currency($this->getTotalSaleAndAdderAndFeeWithTax(),'EUR');
    } 
    
      function getTotalSaleAndAdderWithoutTax()
    {
        return $this->getTotalSaleAndAdderWithTax() - $this->getTotalSaleAndAdderTax();                                
    }
    
     function getFormattedTotalSaleAndAdderWithoutTax()
    {
        return format_currency($this->getTotalSaleAndAdderWithoutTax(),'EUR');
    } 
    
    function getTotalSaleAndAdderTax()
    {
        return round($this->getTotalSaleAndAdderWithTax() - ( $this->getTotalSaleAndAdderWithTax() / ( 1.0 + 0.055)),2);
    }
    
     function getFormattedTotalSaleAndAdderTax()
    {
        return format_currency($this->getTotalSaleAndAdderTax(),'EUR');
    }
        
    function getTotalSaleAndAdderAndFeeTax()
    {
        return $this->getTotalSaleAndAdderTax() + $this->getTotalTaxFeeFile();
    }
    
      function getFormattedTotalSaleAndAdderAndFeeTax()
    {
        return format_currency($this->getTotalSaleAndAdderAndFeeTax(),'EUR');
    }
    
     function getTotalSaleAndAdderAndFeeWithoutTax()
    {
        return $this->getTotalSaleAndAdderAndFeeWithTax() -  $this->getTotalSaleAndAdderAndFeeTax();
    }
    
      function getFormattedTotalSaleAndAdderAndFeeWithoutTax()
    {
        return format_currency($this->getTotalSaleAndAdderAndFeeWithoutTax(),'EUR');
    }
    
    function getTotalPrimeAndAdderAndFeeAndRestInChargeWithTax()
    {
        return $this->getTotalSaleAndAdderWithTax() - $this->getTotalRestInChargeWithTax();
    }
    
     function getFormattedTotalPrimeAndAdderAndFeeAndRestInChargeWithTax()
    {
        return format_currency($this->getTotalPrimeAndAdderAndFeeAndRestInChargeWithTax(),'EUR');
    }
    
   /*  function getRestToPayWithTax()
    {
        return $this->getTotalSaleAndAdderAndFeeWithTax() - $this->getTotalPrimeAndAdderAndFeeAndRestInChargeWithTax();
    }  */
    
    function getFormattedRestToPayWithTax()
    {
         return format_currency($this->getRestToPayWithTax(),'EUR');
    }
    
     function getRestToPayWithTax()
    {
        return $this->getTotalSaleAndAdderAndFeeWithTax() - $this->getTotalSaleWithTax();
    }  
    
    function getTotalSaleAndPrimeWithTax()
    {
        return $this->getTotalSaleWithTax() - $this->getPrime();
    }
    
    function getFormattedTotalSaleAndPrimeWithTax()
    {
        return format_currency($this->getTotalSaleAndPrimeWithTax(),'EUR');
    }
    
    function getFormattedAdvanceWithTax()
    {
        return format_currency($this->getAvanceWithTax(),'EUR');
    }
       
    function getAvanceWithTax()
    {
        return $this->getSettings()->getPourcentageAdvance() * $this->getTotalSaleAndPrimeWithTax();
    }
    
    function getAnaTax()
    {
        return floatval($this->get('ana_prime'));
    }
    
     function getFormattedAnaTax()
    {
        return format_currency($this->getAnaTax(),'EUR');
    }
    
     function getAnaPackTax()
    {
        return $this->get('ana_pack_prime');
    }
    
     function getFormattedAnaPackTax()
    {
        return format_currency($this->getAnaPackTax(),'EUR');
    }
    
    function getTotalSaleAndPrimeAndAnaWithTax()
    {
        return $this->getTotalSaleAndPrimeWithTax() - $this->getAnaTax();
    }
    
    function getFormattedTotalSaleAndPrimeAndAnaWithTax()
    {
        return format_currency($this->getTotalSaleAndPrimeAndAnaWithTax(),'EUR');
    }
    
     function getTotalSaleAndPrimeAndPackPrimeWithTax()
    {
        return $this->getTotalSaleWithTax() - $this->getPrime() - $this->getPackPrime();
    }
    
    function getTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTax()
    {
        return $this->getTotalSaleAndPrimeAndPackPrimeWithTax() - $this->getAnaTax() - $this->getAnaPackTax();
    }
    
    function getFormattedTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTax()
    {
        return format_currency($this->getTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTax(),'EUR');
    }
    
     function getFormattedPackPrime()
    {
        return format_currency($this->getPackPrime(),'EUR');
    }        
    
    function getNumberOfParts()
    {
        return floatval($this->get('number_of_parts'));          
    }
    
      function getFormattedNumberOfParts()
    {
        return format_number($this->getNumberOfParts(),'#.0');
    }         
    
      function getFormattedAnaPrime()
    {
        return format_currency($this->getAnaPrime(),'EUR');
    }
    
     function getITEPrime()
    {
        return floatval($this->get('ite_prime'));          
    }
    
      function getFormattedITEPrime()
    {
        return  format_currency($this->getITEPrime(),'EUR');
    }
    
    function getTotalSaleWithITEPrimeAndAnaPrime()
    {
       return $this->getTotalSaleWithTax() -  $this->getITEPrime() - $this->getAnaPrime();
    }
    
    function getFormattedTotalSaleWithITEPrimeAndAnaPrime()
    {
        return  format_currency($this->getTotalSaleWithITEPrimeAndAnaPrime(),'EUR');
    }
    
    function getTotalSaleWithITEPrime()
    {
       return $this->getTotalSaleWithTax() -  $this->getITEPrime();
    }
    
    function getFormattedTotalSaleWithITEPrime()
    {
        return  format_currency($this->getTotalSaleWithITEPrime(),'EUR');
    }
    
   
    function getTotalSaleWithPackPrimeAndAnaPrime()
    {
       return $this->getTotalSaleWithTax() -  $this->getPackPrime() - $this->getAnaPrime();
    }
    
    function getFormattedTotalSaleWithPackPrimeAndAnaPrime()
    {
        return  format_currency($this->getTotalSaleWithPackPrimeAndAnaPrime(),'EUR');
    }
    
    function getTotalSaleWithPackPrime()
    {
       return $this->getTotalSaleWithTax() -  $this->getPackPrime();
    }
    
    function getFormattedTotalSaleWithPackPrime()
    {
        return  format_currency($this->getTotalSaleWithPackPrime(),'EUR');
    }
    
    function getNumberOfQuotations()
    {
        if ($this->number_of_quotations===null)
        {    
            $db=mfSiteDatabase::getInstance();
            if ($this->hasContract())
            {
                $db->setParameters(array( 'company_id'=>$this->get('company_id'),
                                        'contract_id'=>$this->get('contract_id')
                                        ))                       
                ->setQuery("SELECT count(".DomoprimeQuotation::getTableField('id').") FROM ".DomoprimeQuotation::getTable().                           
                           " WHERE ". DomoprimeQuotation::getTableField('contract_id')."='{contract_id}' AND ".
                                      DomoprimeQuotation::getTableField('company_id').($this->getContract()->hasCompany()?" ='{company_id}' ":" IS NULL").
                           ";");                
            }    
            else
            {    
                $db->setParameters(array('meeting_id'=>$this->get('meeting_id'),
                                        'company_id'=>$this->get('company_id'),                                      
                                        ))                       
                ->setQuery("SELECT count(".DomoprimeQuotation::getTableField('id').") FROM ".DomoprimeQuotation::getTable().                         
                          " WHERE ". DomoprimeQuotation::getTableField('meeting_id')."='{meeting_id}' AND ".
                                     DomoprimeQuotation::getTableField('company_id').($this->getContract()->hasCompany()?" ='{company_id}' ":" IS NULL").
                           ";") ;                     
            }          
            $db ->makeSiteSqlQuery($this->getSite());                   
            $row=$db->fetchRow();
            $this->number_of_quotations=$row[0];                 
        }
        return $this->number_of_quotations;
    }
    
     function hasCompany()
    {
        return (boolean)$this->get('company_id');
    }
    
      function getCompany()
    {
        return $this->_company_id=$this->_company_id===null?new CustomerContractCompany($this->get('company_id'),$this->getSite()):$this->_company_id;
    }
        
     function getTaxes()
     {
         return  $this->_taxes = $this->_taxes ===null ?new DomoprimeQuotationTaxes(new mfJson($this->get('taxes'))):$this->_taxes;
     }
     
      function hasWork()
    {
        return (boolean)$this->get('work_id');
    }
    
      function getWork()
     {
          return  $this->_work_id = $this->_work_id ===null ?new DomoprimeCustomerContractWork($this->get('work_id')):$this->_work_id;
     }
     
       function hasType()
     {
          return  (boolean)$this->get('subvention_type_id');
     }
      
      function getType()
     {
          return  $this->_subvention_type_id = $this->_subvention_type_id ===null ?new DomoprimeSubventionType($this->get('subvention_type_id')):$this->_subvention_type_id;
     }
    
      function getDiscountAmount()
    {
        return  floatval($this->get('discount_amount'));  
    }
    
     function getFormattedDiscountAmount()
    {
        return format_currency($this->getDiscountAmount(),'EUR');                                  
    }
       
    
    function getRestInChargeDiscountAmount()
    {
        return $this->getRestInCharge() - $this->getDiscountAmount();
    }
    
    function getFormattedRestInChargeDiscountAmount()
    {
        return format_currency($this->getRestInChargeDiscountAmount(),'EUR');
    }
    
    // {$quotation.total_sale_and_prime_tax}  - discount
    function getTotalSaleAndPrimeTaxAndDiscount()
    {
        return $this->getTotalSaleAndPrimeWithTax() - $this->getDiscountAmount();
    }
    
    function getFormattedTotalSaleAndPrimeTaxAndDiscount()
    {
        return format_currency($this->getTotalSaleAndPrimeTaxAndDiscount(),'EUR');
    }                 
    
    // {$quotation.total_sale_with_pack_prime} 
     function getTotalSaleAndPackPrimeAndDiscount()
    {
        return $this->getTotalSaleWithPackPrime() - $this->getDiscountAmount();
    }
    
    function getFormattedTotalSaleAndPackPrimeAndDiscount()
    {
        return format_currency($this->getTotalSaleAndPackPrimeAndDiscount(),'EUR');
    } 
    
    // {$quotation.total_sale_with_ite_prime} 
     function getTotalSaleAndItePrimeAndDiscount()
    {
        return $this->getTotalSaleWithITEPrime() - $this->getDiscountAmount();
    }
    
    function getFormattedTotalSaleAndItePrimeTaxAndDiscount()
    {
        return format_currency($this->getTotalSaleAndItePrimeAndDiscount(),'EUR');
    } 
    
    // {$quotation.total_sale_and_prime_and_pack_prime_and_ana_and_ana_pack_tax} 
     function getTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTaxAndDiscount()
    {
        return $this->getTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTax() - $this->getDiscountAmount();
    }
    
    function getFormattedTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTaxAndDiscount()
    {
        return format_currency($this->getTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTaxAndDiscount(),'EUR');
    } 
    
    //{$quotation.rest_in_charge} 
     function getRestInChargeAndDiscount()
    {
        return $this->getRestInCharge() - $this->getDiscountAmount();
    }
    
    function getRestInChargeWithTax()
    {
        return $this->getRestInCharge();
    }
    
    function getFormattedRestInChargeAndDiscount()
    {
        return format_currency($this->getRestInChargeAndDiscount(),'EUR');
    } 
    
    // {$quotation.total_sale_with_ite_prime_and_ana_prime}
      function getTotalSaleWithITEPrimeAndAnaPrimeAndDiscount()
    {
        return $this->getTotalSaleWithITEPrimeAndAnaPrime() - $this->getDiscountAmount();
    }
    
    function getFormattedTotalSaleWithITEPrimeAndAnaPrimeAndDiscount()
    {
        return format_currency($this->getTotalSaleWithITEPrimeAndAnaPrimeAndDiscount(),'EUR');
    } 
    
     // {$quotation.total_sale_with_tax}
     function getTotalSaleWithTaxAndDiscount()
    {
        return $this->getTotalSaleWithTax() - $this->getDiscountAmount();
    }
    
    function getFormattedTotalSaleWithTaxAndDiscount()
    {
        return format_currency($this->getTotalSaleWithTaxAndDiscount(),'EUR');
    } 
    
    
     // {{$quotation.total_sale_and_prime_tax
     function getTotalSaleAndPrimeWithTaxAndDiscount()
    {
        return $this->getTotalSaleAndPrimeWithTax() - $this->getDiscountAmount();
    }
    
    function getFormattedTotalSaleAndPrimeWithTaxAndDiscount()
    {
        return format_currency($this->getTotalSaleAndPrimeWithTaxAndDiscount(),'EUR');
    } 
   
    // {$quotation.total_sale_with_pack_prime} 
     function getTotalSaleWithPackPrimeAndDiscount()
    {
        return $this->getTotalSaleWithPackPrime() - $this->getDiscountAmount();
    }
    
    function getFormattedTotalSaleWithPackPrimeAndDiscount()
    {
        return format_currency($this->getTotalSaleWithPackPrimeAndDiscount(),'EUR');
    } 
    
     
    static function getQuotationsFromWorksForContract(CustomerContract $contract)
    {        
        $list = new DomoprimeQuotationCollection(null,$contract->getSite());
           $db=mfSiteDatabase::getInstance()
                ->setParameters(array('contract_id'=>$contract->get('id')))      
                ->setObjects(array('DomoprimeQuotation','DomoprimeCustomerContractWork'))
                ->setQuery("SELECT {fields} FROM ".DomoprimeQuotation::getTable().
                           " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('work_id').
                           " WHERE ".DomoprimeQuotation::getTableField('contract_id')."='{contract_id}' AND ".
                                    DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE' AND ".
                                    DomoprimeQuotation::getTableFIeld('is_last')."='YES'".
                           ";")
                ->makeSiteSqlQuery($contract->getSite());   
        // echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;
        while ($items=$db->fetchObjects())
        {        
            $item=$items->getDomoprimeQuotation();
            $item->set('work_id',$items->getDomoprimeCustomerContractWork());
            $list[$item->get('id')]=$item;
        }
        $list->loaded();
        return $list;               
    }
    
    
     static function getQuotationsFromWorksForMeeting(CustomerMeeting $meeting)
    {        
        $list = new DomoprimeQuotationCollection(null,$meeting->getSite());
           $db=mfSiteDatabase::getInstance()
                ->setParameters(array('contract_id'=>$meeting->get('id')))      
                ->setObjects(array('DomoprimeQuotation','DomoprimeCustomerContractWork'))
                ->setQuery("SELECT {fields} FROM ".DomoprimeQuotation::getTable().
                           " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('work_id').
                           " WHERE ".DomoprimeQuotation::getTableField('meeting_id')."='{meeting_id}' AND ".
                                    DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE' AND ".
                                    DomoprimeQuotation::getTableFIeld('is_last')."='YES'".
                           ";")
                ->makeSiteSqlQuery($meeting->getSite());   
        // echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;
        while ($items=$db->fetchObjects())
        {        
            $item=$items->getDomoprimeQuotation();
            $item->set('work_id',$items->getDomoprimeCustomerContractWork());
            $list[$item->get('id')]=$item;
        }
        $list->loaded();
        return $list;               
    }
  
    function getSubvention()
    {
        return floatval($this->get('subvention'));  // '','bbc_subvention',                
    }
    
    function hasBBCSubvention()
    {
        return (boolean)$this->get('bbc_subvention');
    }
    
    function getFormattedSubvention()
    {
        return format_currency($this->getSubvention(),'EUR');
    }
    
    function getBBCSubvention()
    {
        return floatval($this->get('bbc_subvention'));  // '','bbc_subvention',                
    }
    
    function getFormattedBBcSubvention()
    {
        return format_currency($this->getBBCSubvention(),'EUR');
    }
    
    function hasPassoireSubvention()
    {
        return (boolean)$this->get('passoire_subvention');
    }
    
    function getPassoireSubvention()
    {
        return floatval($this->get('passoire_subvention'));  // '','bbc_subvention',                
    }
    
    function getFormattedPassoireSubvention()
    {
        return format_currency($this->getPassoireSubvention(),'EUR');
    }
    
    function getCeePrime()
    {
        return floatval($this->get('cee_prime'));   
    }
    
    function getFormattedCeePrime()
    {
        return format_currency($this->getCeePrime(),'EUR');
    }
    
    
    //ttc_cee_bbc_passoire_remise
    function getTotalSaleAndCeeAndBBCAndSubventionWithTaxAndDiscount()
    {
       return $this->getTotalSaleWithTax() - $this->getCeePrime() - $this->getBBCSubvention() - $this->getSubvention() - $this->getDiscountAmount(); 
    }
    
    function getFormattedTotalSaleAndCeeAndBBCAndSubventionWithTaxAndDiscount()
    {
        return format_currency($this->getTotalSaleAndCeeAndBBCAndSubventionWithTaxAndDiscount(),'EUR');
    }
    
    //ttc_cee_anah_bbc_passoire_remise
    function getTotalSaleAndCeeAndAnahBBCAndSubventionWithTaxAndDiscount()
    {
        return $this->getTotalSaleWithTax() - $this->getAnaTax() - $this->getCeePrime() - $this->getBBCSubvention() - $this->getSubvention() - $this->getDiscountAmount(); 
    }
    
    function getFormattedTotalSaleAndCeeAndAnahBBCAndSubventionWithTaxAndDiscount()
    {
        return format_currency($this->getTotalSaleAndCeeAndAnahBBCAndSubventionWithTaxAndDiscount(),'EUR'); 
    }
    
    //ttc_anah_bbc_passoire_remise
    function getTotalSaleAndAnahBBCAndSubventionWithTaxAndDiscount()
    {
       return $this->getTotalSaleWithTax() - $this->getAnaTax() - $this->getBBCSubvention() - $this->getSubvention() - $this->getDiscountAmount();  
    }
    
    function getFormattedTotalSaleAndAnahBBCAndSubventionWithTaxAndDiscount()
    {
       return format_currency($this->getTotalSaleAndAnahBBCAndSubventionWithTaxAndDiscount(),'EUR');  
    }
    
    
     function getTotalSaleWithITEPrimeAndAnaPrimeAndDiscountAndBBCAndPassoire()
    {
        return $this->getTotalSaleWithITEPrimeAndAnaPrime() - $this->getDiscountAmount() - $this->getBBCSubvention() - $this->getPassoireSubvention();
    }
    
    function getFormattedTotalSaleWithITEPrimeAndAnaPrimeAndDiscountAndBBCAndPassoire()
    {
        return format_currency($this->getTotalSaleWithITEPrimeAndAnaPrimeAndDiscountAndBBCAndPassoire(),'EUR');
    } 
    
    
     
     function getTotalSaleAndPrimeAndAnaWithTaxAndDiscount()
    {
        return $this->getTotalSaleWithTax() - $this->getPrime() - $this->getAnaTax() - $this->getDiscountAmount();
    } 
    
    // total_sale_and_prime_and_ana_tax_discount
    function getFormattedTotalSaleAndPrimeAndAnaWithTaxAndDiscount()
    {
        return format_currency($this->getTotalSaleAndPrimeAndAnaWithTaxAndDiscount(),'EUR');
    }     
    
     function getTotalSaleAndPackPrimeAndAnaPackWithTaxAndDiscount()
    {
        return $this->getTotalSaleWithTax() - $this->getPackPrime() - $this->getAnaTax() - $this->getDiscountAmount();
    } 
     // total_sale_and_pack_prime_and_ana_pack_tax_discount 
    function getFormattedTotalSaleAndPackPrimeAndAnaPackWithTaxAndDiscount()
    {
        return format_currency($this->getTotalSaleAndPackPrimeAndAnaPackWithTaxAndDiscount(),'EUR');
    } 
        
    function getTotalSaleWithoutTaxMinusDiscountPrice()
    {
        return $this->getTotalSaleWithoutTax() - $this->getTotalSaleDiscountWithoutTax();
    }
    
    
     function getFormattedTotalSaleWithoutTaxMinusDiscountPrice()
    {
        return format_currency($this->getTotalSaleWithoutTaxMinusDiscountPrice(),'EUR');
    }
    
     function getTotalSaleWithTaxMinusDiscountPrice()
    {
        return $this->getTotalSaleWithTax() - $this->getTotalSaleDiscountWithTax();
    }
    
    
     function getFormattedTotalSaleWithTaxMinusDiscountPrice()
    {
        return format_currency($this->getTotalSaleWithTaxMinusDiscountPrice(),'EUR');
    }
    
    
     function toArrayForApi2($options)
    {      
        return $this->formatter_api2=$this->formatter_api2===null?new DomoprimeQuotationItemFormatterApi2($this,$options):$this->formatter_api2;
    }
    
    
    function getCalculation()
    {
        return $this->_calculation_id=$this->_calculation_id===null?new DomoprimeCalculation($this->get('calculation_id'),$this->getSite()):$this->_calculation_id;
    }
    
    
}
