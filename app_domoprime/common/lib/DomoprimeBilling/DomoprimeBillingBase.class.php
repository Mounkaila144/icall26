<?php

class DomoprimeBillingBase extends mfObject2 {
     
    protected static $fields=array('meeting_id','contract_id','reference','day','month','year','status',
                                   'total_sale_without_tax',
                                   'total_sale_with_tax',
                                   'total_purchase_with_tax',
                                   'total_purchase_without_tax',                                   
                                   'comments','status_id','dated_at','rest_in_charge',
                                   'total_tax','is_last','prime','tax_credit','number_of_children',
                                 //  'total_paid_with_tax',
                                 //  'total_unpaid_with_tax',
                                 //  'is_locked',
                                   // 'one_euro',
                                   'total_sale_discount_with_tax',
                                   'total_sale_discount_without_tax',
                                   'number_of_people','tax_credit_used','qmac_value',
                                   'rest_in_charge_after_credit','tax_credit_limit', 'tax_credit_available',
                                   'one_euro','fee_file',
                                   'fixed_prime',
                                   'customer_id','quotation_id','creator_id',                                  
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
                                   'total_restincharge_with_tax_top','cee_prime',
                                   'total_restincharge_without_tax_top', 'company_id',                                
                                   'pack_prime','ana_prime','ana_pack_prime','number_of_parts','ite_prime',
                                   'taxes','work_id',  'discount_amount',    
                                   'subvention_type_id','mode', 'type','polluter_id','calculation_id',
                                   'subvention','bbc_subvention','passoire_subvention',
                                   'created_at','updated_at');
    const table="t_domoprime_billing"; 
    protected static $foreignKeys=array('meeting_id'=>'CustomerMeeting',    
                                        'customer_id'=>'Customer',  
                                        'contract_id'=>'CustomerContract',   
                                        'quotation_id'=>'DomoprimeQuotation',
                                        'creator_id'=>'User',       
                                        'company_id'=>'CustomerContractCompany',
                                        'work_id'=>'DomoprimeCustomerContractWork',
                                        'subvention_type_id'=>'DomoprimeSubventionType',
                                        'polluter_id'=>'DomoprimePollutingCompany',
                                           'calculation_id'=>'DomoprimeCalculation',
                                        //'status_id'=>'CustomerContractBillingStatus'
                                        ); 
    protected static $fieldsNull=array( 'calculation_id','meeting_id','contract_id','tax_credit','company_id','work_id','dated_at','subvention_type_id', 'polluter_id',); // By default
    protected static $months=array("january","february","march","april","may",
                                   "june","july","august","september","october",
                                   "november","december");    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
         //  if (isset($parameters['contract']) && isset($parameters['mode']) && isset($parameters['contract']) instanceof CustomerContract)
         //    return $this->loadbyLastContractAndMode($parameters['contract'],$parameters['mode']);      
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']);         
          return $this->add($parameters); 
      }   
      else
      {
         if ($parameters instanceof DomoprimeQuotation)
            return $this->loadByLastQuotation($parameters);    
          if ($parameters instanceof CustomerContract)
            return $this->loadByLastBillingForContract($parameters); 
            if ($parameters instanceof DomoprimeCustomerContractWork)
             return $this->loadLastBillingForWork($parameters);
         if (is_numeric((string)$parameters))                     
            return $this->loadbyId((string)$parameters);                 
      }   
    }       
    
      protected function loadLastBillingForWork(DomoprimeCustomerContractWork $work)
    {                   
         $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('work_id'=>$work->get('id')))
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE work_id='{work_id}'".
                           " ORDER BY id DESC ".
                           " LIMIT 0,1".
                           ";")
            ->makeSiteSqlQuery($this->site);   
        //echo $db->getQuery();
         return $this->rowtoObject($db);
    }
    
   /*  protected function loadByLastContractAndMode(CustomerContract $contract,$mode)
    {        
         $this->set('contract_id',$contract);
         $db=mfSiteDatabase::getInstance()
             ->setParameters(array('contract_id'=>$contract->get('id'),'mode'=>$mode))
             ->setQuery("SELECT * FROM ".self::getTable()." WHERE contract_id='{contract_id}' AND mode='{mode}' AND is_last='YES'".
                        " ORDER BY id DESC".
                        " LIMIT 0,1".
                        ";")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }*/
    
     protected function loadByLastBillingForContract(CustomerContract $contract)
    {        
         $this->set('contract_id',$contract);
         $db=mfSiteDatabase::getInstance()
             ->setParameters(array('contract_id'=>$contract->get('id')))
             ->setQuery("SELECT * FROM ".self::getTable()." WHERE contract_id='{contract_id}'".
                        " ORDER BY id DESC".
                        " LIMIT 0,1".
                        ";")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
    protected function loadByLastQuotation(DomoprimeQuotation $quotation)
    {        
         $db=mfSiteDatabase::getInstance()
             ->setParameters(array('quotation_id'=>$quotation->get('id')))
             ->setQuery("SELECT * FROM ".self::getTable()." WHERE quotation_id='{quotation_id}'".
                        " ORDER BY id DESC".
                        " LIMIT 0,1".
                        ";")
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
      $this->is_last=isset($this->is_last)?$this->is_last:"YES";  
      $this->status=isset($this->status)?$this->status:"ACTIVE";
      $this->prime=isset($this->prime)?$this->prime:0.0;       
      $this->fixed_prime=isset($this->fixed_prime)?$this->fixed_prime:0.0;   
      $this->tax_credit=isset($this->tax_credit)?$this->tax_credit:0.0;  
      $this->tax_credit_used=isset($this->tax_credit_used)?$this->tax_credit_used:0.0;  
      $this->qmac=isset($this->qmac)?$this->qmac:0.0;  
      $this->one_euro=isset($this->one_euro)?$this->one_euro:'YES'; 
      $this->tax_credit_available=isset($this-> tax_credit_available)?$this->tax_credit_available:0.0;
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
    
    function getContract()
    {
        if ($this->_contract_id===null)
        {
            $this->_contract_id=new CustomerContract($this->get('contract_id'),$this->getSite());
        }   
        return $this->_contract_id;
    }
    
    function getPolluter()
    {
        return $this->_polluter_id=$this->_polluter_id===null?$this->_polluterid=new DomoprimePollutingCompany($this->get('polluter_id'),$this->getSite()):$this->_polluter_id;
    }
    
    function getNumberOfBillingsOfDay()
    {
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('day'=>$this->get('day'),
                                 'month'=>$this->get('month'),
                                 'id'=>$this->get('id'),
                                 'year'=>$this->get('year')))
         ->setQuery("SELECT count(id) FROM ".self::getTable().
                    " WHERE year='{year}' AND month='{month}' AND  day='{day}' AND id <='{id}'".
                    ";")
         ->makeSiteSqlQuery($this->site); 
       // var_dump($db->getQuery());
        $row=$db->fetchRow();
        return $row[0];
    }
    
    function getNumberOfBillingsOfMonth()
    {
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array( 
                                 'month'=>$this->get('month'),
                                 'id'=>$this->get('id'),
                                 'year'=>$this->get('year')))
         ->setQuery("SELECT count(id) FROM ".self::getTable().
                    " WHERE year='{year}' AND month='{month}' AND id <='{id}'".
                    ";")
         ->makeSiteSqlQuery($this->site); 
       // var_dump($db->getQuery());
        $row=$db->fetchRow();
        return $row[0];
    }
    
    function createFromQuotation(CustomerContract $contract,$quotation,$user)
    {
        $this->createFromQuotationWithUser($contract,$quotation,$user);
        return $this;
    }
            
    function createFromQuotationWithUser(CustomerContract $contract, DomoprimeQuotation $quotation,$user)
    {
        if (!$quotation || $quotation->isNotLoaded())
            return $this;
        $this->set('contract_id',$contract);
        $this->set('meeting_id',$contract->getMeeting());
        $this->set('customer_id',$contract->getCustomer());
        $this->set('quotation_id',$quotation);       
        $this->set('company_id',$quotation->get('company_id'));  
        if ($user->hasCredential(array(array('app_domoprime_billing_date_from_billing_contract'))))
        {
            $this->set('dated_at',$contract->get('billing_at'));
            $this->set('month',$contract->getBillingAtDate()->getMonth());
            $this->set('year',$contract->getBillingAtDate()->getYear());
            $this->set('day',$contract->getBillingAtDate()->getDay());
        }   
        else
        {
            $this->set('dated_at',$contract->get('opc_at'));
            $this->set('month',$contract->getOpcAtDate()->getMonth());
            $this->set('year',$contract->getOpcAtDate()->getYear());
            $this->set('day',$contract->getOpcAtDate()->getDay());
        }
        $this->set('creator_id',$user->getGuardUser());
         foreach (array('total_sale_without_tax','total_sale_with_tax',
                        'total_tax',        
                        'fixed_prime','fee_file',
                        'prime','tax_credit', 'number_of_children','rest_in_charge',
                        'number_of_people','tax_credit_used','qmac',                                   
                        'total_purchase_with_tax','total_purchase_without_tax',
                        'total_sale_discount_with_tax','total_sale_discount_without_tax',             
                        'total_sale_101_with_tax','total_sale_101_without_tax',        
                        'total_sale_102_with_tax','total_sale_102_without_tax',        
                        'total_sale_103_with_tax','total_sale_103_without_tax',
                        'total_added_with_tax_wall','total_added_without_tax_wall',        
                        'total_added_with_tax_floor','total_added_without_tax_floor',        
                        'total_added_with_tax_top','total_added_without_tax_top',
                        'total_restincharge_with_tax_wall','total_restincharge_without_tax_wall',        
                        'total_restincharge_with_tax_floor','total_restincharge_without_tax_floor',        
                        'total_restincharge_with_tax_top','total_restincharge_without_tax_top',                          
                        'total_sale_and_adder_with_tax',
                        'total_sale_and_adder_and_fee_with_tax',
                        'total_sale_and_adder_tax',    'subvention_type_id','work_id',                     
                        'pack_prime','ite_prime','taxes', 'discount_amount',     
                        'ana_prime','ana_pack_prime','number_of_parts',
                        'cee_prime','subvention','bbc_subvention','passoire_subvention',
                        'mode',
                    ) as $field)
        {
            $this->set($field,$quotation->get($field));
        }   
        $this->save();   
        $this->updateLastFromContract();                
        $this->set('reference',$this->loadReference());
        $this->save();
        $products=new DomoprimeBillingProductCollection(null,$this->getSite());
        foreach ($quotation->getProductsWithItems() as $index=>$product)
        {
            $item=new DomoprimeBillingProduct(null,$this->getSite());
            $item->set('billing_id',$this);
            $item->set('contract_id',$contract);
            $item->createFromQuotationProduct($product);
            $products[$index]=$item;
        }                     
        $products->save();
      //  echo "<pre>"; var_dump($products); echo "</pre>"; 
        $items=new DomoprimeBillingProductItemCollection(null,$this->getSite());
     //   echo "<pre>"; var_dump($quotation->getProductsWithItems());
        foreach ($quotation->getProductsWithItems() as $index=>$product) // DomoprimeQuotationProduct
        {   
            foreach ($product->getItems() as $product_item )
            {
                $item=new DomoprimeBillingProductItem(null,$this->getSite());
                $item->set('billing_id',$this);           
                $item->set('billing_product_id',$products[$index]->get('id'));             
                $item->createFromQuotationItem($product_item);
                $items[]=$item;
            }    
           /*  $item=new DomoprimeBillingProductItem(null,$this->getSite());
             $item->set('billing_id',$this);           
             $item->set('billing_product_id',$products[$index]->get('id'));             
             $item->createFromQuotationItem($product->get);
             $items[]=$item;*/
        }    
        $items->save();
        return $this;
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
    
     function getTotalTax()
    {
        return floatval($this->get('total_tax'));                                      
    }
    
     function getTotalSaleTax()
    {
        return $this->getTotalSaleWithTax() - $this->getTotalSaleWithoutTax();                                  
    }
    
    
     function getFormattedTotalSaleTax()
    {
        return format_currency($this->getTotalSaleTax(),'EUR');                                  
    }
    
    function getDiscountAmount()
    {
        return  floatval($this->get('discount_amount'));  
    }
    
     function getFormattedDiscountAmount()
    {
        return format_currency($this->getDiscountAmount(),'EUR');                                  
    }
    
    function getProductsWithItems()
    {
        if ($this->products===null)
        {
            $this->products=new DomoprimeBillingProductCollection(null,$this->getSite());
            
              $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('billing_id'=>$this->get('id')))
                         ->setObjects(array('DomoprimeBillingProduct','DomoprimeBillingProductItem','ProductItem'))
                         ->setQuery("SELECT {fields} FROM ".DomoprimeBillingProduct::getTable().    
                                    " INNER JOIN ".DomoprimeBillingProductItem::getInnerForJoin('billing_product_id'). 
                                    " INNER JOIN ".DomoprimeBillingProductItem::getOuterForJoin('item_id'). 
                                    " WHERE ".DomoprimeBillingProduct::getTableField('billing_id')."='{billing_id}' ".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());    
          //   echo $db->getQuery();
                if (!$db->getNumRows())
                    return $this->products;                           
               while ($items=$db->fetchObjects())
               {                     
                   $item=$items->getDomoprimeBillingProduct();
                   if (!isset($this->products[$item->get('id')]))
                        $this->products[$item->get('id')]=$item;
                   $items->getDomoprimeBillingProductItem()->set('product_item_id',$items->getProductItem());
                   $this->products[$item->get('id')]->addItem($items->getDomoprimeBillingProductItem());
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
                         ->setParameters(array('billing_id'=>$this->get('id')))                        
                         ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".Product::getTable().                                   
                                    " INNER JOIN ".DomoprimeBillingProduct::getInnerForJoin('product_id').
                                    " WHERE billing_id='{billing_id}' ".                                    
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
    
    function toArrayForBilling()
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
                       'tax_credit_limit'=>'FormattedTaxCreditLimit',                       
                       'number_of_people'=>'FormattedNumberOfPeople',
                       'number_of_children'=>'FormattedNumberOfChildren',
                       'rest_in_charge_after_credit'=>'FormattedRestInChargeAfterCredit',
                       'reference'=>'FormattedReference',   
                       'tax_credit_available'=>'FormattedTaxCreditAvailable',
                       'prime_oneeuro'=>'FormattedCurrencyPrimeOneEuro',
                       'prime_one_euro'=>'FormattedPrimeOneEuro',
            
                       'fee_file'=>'FormattedFeeFile',
                       'fee_file_without_tax'=>'FormattedFeeFileWithoutTax',
                       'total_sale_with_tax_and_fee'=>'FormattedTotalPriceWithTaxAndFeeFile',
                       'total_sale_without_tax_and_fee'=>'FormattedTotalPriceWithoutTaxAndFeeFile',
                       'tax_fee_file_eur'=>'FormattedTaxFeeFile',
                       'tax_fee_file'=>'TaxFeeFile',
            
                       'prime_rounded_one_euro'=>'FormattedRoundedPrimeOneEuro',                      
                       'total_sale_with_tax_and_fee'=>'FormattedTotalPriceWithTaxAndFeeFile',
                       'total_sale_without_tax_and_fee'=>'FormattedTotalPriceWithoutTaxAndFeeFile',                                            
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
                       'total_sale_and_prime_tax'=>'FormattedTotalSaleAndPrimeWithTax',
                       'advance_tax'=>'FormattedAdvanceWithTax' ,
            
                       'pack_prime'=>'FormattedPackPrime',                       
                       'total_sale_and_prime_ana_tax'=>'FormattedTotalSaleAndPrimeAndAnaWithTax',
                       'ana_tax'=>'FormattedAnaTax',
                       'ana_pack_tax'=>'FormattedAnaPackTax',            
                       'total_sale_and_prime_and_pack_prime_and_ana_and_ana_pack_tax'=>'FormattedTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTax',
                       'total_tax_with_fee'=>'FormattedTotalTaxWithFee',
                       'pack_prime'=>'FormattedPackPrime',
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
                    'total_sale_with_pack_prime_discount'=>'FormattedTotalSaleWithPackPrimeAndDiscount',
                    'cee_prime'=>'FormattedCeePrime',
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
        $values['taxes']=$this->getTaxes()->toArray();    
      //  if ($this->hasType())
      //       $values['subvention_type']=$this->getType()->toArray();
        return $values;
    }
    
     function getPrime()
    {
         return floatval($this->get('prime'));         
      //  $settings=DomoprimeSettings::load($this->getSite());
      //  return $this->getTotalSaleWithTax() - $settings->getRestInCharge(); 
    }
    
      function getFixedPrime()
    {
         return floatval($this->get('fixed_prime'));         
      //  $settings=DomoprimeSettings::load($this->getSite());
      //  return $this->getTotalSaleWithTax() - $settings->getRestInCharge(); 
    }
    
     function getFeeFile()
    {
         return 1.00; //floatval($this->get('fee_file'));              
    }

    function getFormattedPrime()
    {
        return format_currency($this->getPrime(),'EUR'); 
    }  
    
     function getFormattedFeeFile()
    {
        return format_currency($this->getFeeFile(),'EUR'); 
    } 
    
     function getFormattedFixedPrime()
    {
        return format_currency($this->getFixedPrime(),'EUR'); 
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
    
    function getQuotation()
    {
        if ($this->_quotation_id===null)
        {
            $this->_quotation_id=new DomoprimeQuotation($this->get('quotation_id'),$this->getSite());            
        }   
        return $this->_quotation_id;
    }
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new DomoprimeBillingFormatter($this);
        }   
        return  $this->formatter;
    }
    
    function loadReference()
    {        
        $settings_field=$this->get('mode')=='multiple'?"contract_billing_reference_format":"billing_reference_format";
        $parameters=array('{id}'=>$this->get('id'),
                          '{yyyy}'=>$this->getDatedAtDate()->getYear(),
                          '{mm}'=>$this->getDatedAtDate()->getMonth(),
                          '{id_day}'=>$this->getNumberOfBillingsOfDay(),
                          '{id_month}'=>$this->getNumberOfBillingsOfMonth(),
                          '{id_work}'=>$this->get('work_id'),
                          '{dd}'=>$this->getDatedAtDate()->getDay());
        if (strpos($this->getSettings()->get($settings_field),'{id_company}')!==false)            
           $parameters['{id_company}'] = $this->getNumberOfBillings() ;        
        return strtr($this->getSettings()->get($settings_field), $parameters);                          
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
    
    
    
    static function generateBillingsForContracts(CustomerContractMultipleProcess $multiple)
    {        
        //var_dump($multiple->getSelection());
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('DomoprimeQuotation','CustomerContract'))
                ->setQuery("SELECT {fields} FROM ".DomoprimeQuotation::getTable().   
                           " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('meeting_id').
                           " INNER JOIN ".CustomerContract::getInnerForJoin('meeting_id').
                           " LEFT JOIN ".DomoprimeBilling::getInnerForJoin('quotation_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$multiple->getSelection()->implode("','")."')".
                                " AND ".DomoprimeBilling::getTableField('id')." IS NULL".       
                                " AND ".CustomerContract::getTableField('opc_at')."!=''".
                                " AND ".DomoprimeQuotation::getTableField('status')."='ACTIVE'".                              
                           ";")
                ->makeSiteSqlQuery($multiple->getSite());
       // echo $db->getQuery(); return 0;        
         if (!$db->getNumRows())
             return 0;
         $quotation_collection=new DomoprimeQuotationCollection(null,$multiple->getSite());
         $contract_collection=new CustomerContractCollection(null,$multiple->getSite());
         while ($items=$db->fetchObjects())
         {
            $item=$items->getDomoprimeQuotation();
            $item->contract=$items->getCustomerContract();
            if (!isset($contract_collection[$item->contract->get('id')]))
                $contract_collection[$item->contract->get('id')]=$item->contract;
            $quotation_collection[]=$item;
         }   
         $contract_collection->loaded();
         $quotation_collection->createBillings($multiple->getUser());   
         foreach ($contract_collection as $contract)
             $contract->setClosedAtFromOpcAt();
         $contract_collection->save();
         return $quotation_collection->count();
    }     
    
    
    static function getBillingsFromSelection($selection,$site=null)
    {         
         $collection=new DomoprimeBillingCollection(null,$site);
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())               
                ->setQuery("SELECT * FROM ". DomoprimeBilling::getTable().                            
                           " WHERE ".DomoprimeBilling::getTableField('contract_id')." IN('".$selection->implode("','")."')".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
     // echo $db->getQuery();
        if (!$db->getNumRows())
            return $collection;
        while ($item=$db->fetchObject('DomoprimeBilling'))
        {
            $collection[$item->get('id')]=$item->loaded()->setSite($site);
        }        
        return $collection;
    }
    
    function getFileForPdf()
    {
        return new File($this->getFilenameForPdf());
    }
    
     function getFilenameForPdf()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/data/domoprime/billings/".$this->get('id')."/".__("billing")."_".$this->get('reference')."_".$this->get('id').".pdf";                            
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
                       'rest_in_charge'=>'FormattedRestInCharge',
                       'tax_credit_limit'=>'FormattedTaxCreditLimit',
                       'number_of_people'=>'FormattedNumberOfPeople',
                       'number_of_children'=>'FormattedNumberOfChildren',
                       'rest_in_charge_after_credit'=>'FormattedRestInChargeAfterCredit',
                       'reference'=>'FormattedReference',                         
                       'tax_credit_available'=>'FormattedTaxCreditAvailable',
                       'prime_oneeuro'=>'FormattedCurrencyPrimeOneEuro',
                       'prime_one_euro'=>'FormattedPrimeOneEuro',
                       'fee_file'=>'FormattedFeeFile',
                       'fee_file_without_tax'=>'FormattedFeeFileWithoutTax',
                       'total_sale_with_tax_and_fee'=>'FormattedTotalPriceWithTaxAndFeeFile',
                       'total_sale_without_tax_and_fee'=>'FormattedTotalPriceWithoutTaxAndFeeFile',
                       'tax_fee_file_eur'=>'FormattedTaxFeeFile',
                       'tax_fee_file'=>'TaxFeeFile',
                                                         
                       'prime_rounded_one_euro'=>'FormattedRoundedPrimeOneEuro',                      
                       'total_sale_with_tax_and_fee'=>'FormattedTotalPriceWithTaxAndFeeFile',
                       'total_sale_without_tax_and_fee'=>'FormattedTotalPriceWithoutTaxAndFeeFile',                                            
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
                       'total_sale_and_prime_tax'=>'FormattedTotalSaleAndPrimeWithTax',
                       'advance_tax'=>'FormattedAdvanceWithTax' ,
                       'ana_tax'=>'FormattedAnaTax',
                       'total_sale_and_prime_ana_tax'=>'FormattedTotalSaleAndPrimeAndAnaWithTax', 
                       'pack_prime'=>'FormattedPackPrime',
                       'ana_pack_tax'=>'FormattedAnaPackTax',
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
                    'total_sale_with_pack_prime_discount'=>'FormattedTotalSaleWithPackPrimeAndDiscount',
                    'subvention'=>'FormattedSubvention',
                    'bbc_subvention'=>'FormattedBBcSubvention',
            'cee_prime'=>'FormattedCeePrime',
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
        $values['taxes']=$this->getTaxes()->toArray();      
      //  if ($this->hasType())
      //       $values['subvention_type']=$this->getType()->toArray();
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
    
      function getDatedAtDate()
     {
         return new Day($this->get('dated_at'));
     } 
     
     
      function getNumberOfPeople()
    {
        return floatval($this->get('number_of_people'));
    }
        
    
       function getNumberOfChildren()
    {
        return floatval($this->get('number_of_children'));
    }
    
    function getFormattedNumberOfChildren()
    {
        return format_number($this->getNumberOfChildren(),'#.0'); 
    }
    
    function getFormattedNumberOfPeople()
    {
        return format_number($this->getNumberOfPeople(),'#.0'); 
    }
    
    function getFormattedTaxCredit()
    {
        return format_currency($this->getTaxCredit(),'EUR'); 
    } 
    
    function getFormattedTaxCreditUsed()
    {
        return format_currency($this->getTaxCreditUsed(),'EUR'); 
    }
    
     function getTaxCredit()
    {
         return floatval($this->get('tax_credit'));
    } 
    
    function getTaxCreditUsed()
    {
         return floatval($this->get('tax_credit_used'));
    }
    
    function getQmac()
    {
        return floatval($this->get('qmac_value'));                                      
    }
    
    
     function getFormattedQmac()
    {
        return format_currency($this->getQmac(),'EUR');                                  
    }
    
    function getRestInCharge()
    {
        return floatval($this->get('rest_in_charge'));                                      
    }
    
     function getFormattedRestInCharge()
    {
        return format_currency($this->getRestInCharge(),'EUR');                                  
    }
    
    
      function getTaxCreditAvailable()
    {
        return floatval($this->get('tax_credit_avaiable')); 
    }
    
    function getFormattedTaxCreditAvailable()
    {
        return format_currency($this->getTaxCreditAvailable(),"EUR");
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
    
      function getFormattedReference()
    {                
        return $this->get('reference') ;
    }  
    
     function hasMeeting()
    {
        return (boolean)$this->get('meeting_id');
    }
    
    function hasContract()
    {
        return (boolean)$this->get('contract_id');
    }
    
    function getUrl()
    {
        return url_to('app_domoprime',['action'=>'ExportBillingPdf'])."?".__('Billing')."=".$this->get('id');
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
    
    function getSettings()
    {
        if ($this->settings===null)
        {
           $this->settings= new DomoprimeSettings(null,$this->getSite());
        }   
        return $this->settings;
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
    

    
     function getFeeFileWithoutTax()
    {
         return 0.83; //$this->getFeeFile() / (1 + $this->getSettings()->get('tax_fee_file','0.2'));              
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
    
    function getTotalTaxFeeFile()
    {
        return 0.17; // $this->getFeeFileWithoutTax() * 0.2;
    }
    
    function getTaxFeeFile()
    {
        return  format_number($this->getTotalTaxFeeFile(),"#.00");
    }
    
   
        function getRoundedPrimeOneEuro()
    {
        return $this->getTotalSaleWithTax() - $this->getSettings()->getRestInCharge() - $this->getFixedPrime();
    }  
           
    
     function getFormattedRoundedPrimeOneEuro()
    {
        return format_number($this->getPrimeOneEuro(),'#.00');
    }            
    
    function getTotalFeeFileWithoutTax()
    {
        return  $this->getFeeFile() - $this->getTotalTaxFeeFile();
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
    
     function getTotalSaleAndAdderAndFeeWitoutTax()
    {
        return $this->getTotalSaleAndAdderAndFeeWithTax() -  $this->getTotalSaleAndAdderAndFeeTax();
    }
    
      function getFormattedTotalSaleAndAdderAndFeeWithoutTax()
    {
        return format_currency($this->getTotalSaleAndAdderAndFeeWitoutTax(),'EUR');
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
    } */  
       
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
        return $this->get('ana_prime');
    }
    
     function getFormattedAnaTax()
    {
        return format_currency($this->getAnaTax(),'EUR');
    }
    
    function getTotalSaleAndPrimeAndAnaWithTax()
    {
        return $this->getTotalSaleAndPrimeWithTax() - $this->getAnaTax();
    }
    
    function getFormattedTotalSaleAndPrimeAndAnaWithTax()
    {
        return format_currency($this->getTotalSaleAndPrimeAndAnaWithTax(),'EUR');
    }
    
    function getPackPrime()
    {
        return floatval($this->get('pack_prime'));          
    }
    
     function getAnaPackTax()
    {
        return floatval($this->get('ana_pack_prime'));          
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
    
     function getFormattedAnaPackTax()
    {
        return format_currency($this->getAnaPackTax(),'EUR');
    }
    
    function getNumberOfParts()
    {
        return floatval($this->get('number_of_parts'));          
    }
    
      function getFormattedNumberOfParts()
    {
        return format_number($this->getNumberOfParts(),'#.0');
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
        return  format_currency($this->getITEPrime(),'EUR');
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
    
      function getAnaPrime()
    {
        return floatval($this->get('ana_prime'));          
    }
    
    function getNumberOfQuotations()
    {
        if ($this->number_of_quotations===null)
        {    
            $db=mfSiteDatabase::getInstance();
            if ($this->hasContract())
            {
                $db->setParameters(array( 'company_id'=>$this->getContract()->get('company_id'),
                                        'contract_id'=>$this->get('contract_id')
                                        ))                       
                ->setQuery("SELECT count(".DomoprimeBilling::getTableField('id').") FROM ".DomoprimeBilling::getTable().  
                           " INNER JOIN ".($this->hasContract()?DomoprimeBilling::getOuterForJoin('contract_id'):DomoprimeBilling::getOuterForJoin('meeting_id')).  
                           " WHERE ". DomoprimeBilling::getTableField('contract_id')."='{contract_id}' AND ".
                                    CustomerContract::getTableField('company_id').($this->getContract()->hasCompany()?" ='{company_id}' ":" IS NULL").
                           ";");                
            }    
            else
            {    
                $db->setParameters(array('meeting_id'=>$this->get('meeting_id'),
                                        'company_id'=>$this->get('company_id'),                                      
                                        ))                       
                ->setQuery("SELECT count(".DomoprimeBilling::getTableField('id').") FROM ".DomoprimeBilling::getTable().  
                           " INNER JOIN ".($this->hasContract()?DomoprimeBilling::getOuterForJoin('meeting_id'):DomoprimeBilling::getOuterForJoin('meeting_id')).  
                          " WHERE ". DomoprimeBilling::getTableField('meeting_id')."='{meeting_id}' AND ".
                                     CustomerContract::getTableField('company_id').($this->getContract()->hasCompany()?" ='{company_id}' ":" IS NULL").
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
    
    function getNumberOfBillings()
    {
        if ($this->number_of_billings===null)
        {    
            $db=mfSiteDatabase::getInstance()
                ->setParameters(array( 'company_id'=>$this->get('company_id'),
                                       // 'contract_id'=>$this->get('contract_id')
                                        ))                       
                ->setQuery("SELECT count(".DomoprimeBilling::getTableField('id').") FROM ".DomoprimeBilling::getTable().                           
                           " WHERE ".DomoprimeBilling::getTableField('company_id').($this->getContract()->hasCompany()?" ='{company_id}' ":" IS NULL").
                        //DomoprimeBilling::getTableField('contract_id')."='{contract_id}' AND ".
                                      
                           ";")
                ->makeSiteSqlQuery($this->getSite());                   
            $row=$db->fetchRow();
            $this->number_of_billings=$row[0];                 
        }
        return $this->number_of_billings;
    }
    
       function getFormattedAnaPrime()
    {
        return format_currency($this->getAnaPrime(),'EUR');
    }
        
     function getTaxes()
     {
         return  $this->_taxes = $this->_taxes ===null ?new DomoprimeBillingTaxes(new mfJson($this->get('taxes'))):$this->_taxes;
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
    
     
  function updateFromQuotationWithUser(DomoprimeQuotation $quotation,$user)
    {
        if (!$quotation || $quotation->isNotLoaded() || $this->isNotLoaded() || $this->getContract()->isNotLoaded())
            return $this;       
        $this->set('meeting_id',$this->getCOntract()->getMeeting());
        $this->set('customer_id',$this->getCOntract()->getCustomer());
        $this->set('quotation_id',$quotation);       
        $this->set('company_id',$quotation->get('company_id'));      
        $this->set('creator_id',$user->getGuardUser());
         foreach (array('total_sale_without_tax','total_sale_with_tax',
                        'total_tax',        
                        'fixed_prime','fee_file',
                        'prime','tax_credit', 'number_of_children','rest_in_charge',
                        'number_of_people','tax_credit_used','qmac',                                   
                        'total_purchase_with_tax','total_purchase_without_tax',
                        'total_sale_discount_with_tax','total_sale_discount_without_tax',             
                        'total_sale_101_with_tax','total_sale_101_without_tax',        
                        'total_sale_102_with_tax','total_sale_102_without_tax',        
                        'total_sale_103_with_tax','total_sale_103_without_tax',
                        'total_added_with_tax_wall','total_added_without_tax_wall',        
                        'total_added_with_tax_floor','total_added_without_tax_floor',        
                        'total_added_with_tax_top','total_added_without_tax_top',
                        'total_restincharge_with_tax_wall','total_restincharge_without_tax_wall',        
                        'total_restincharge_with_tax_floor','total_restincharge_without_tax_floor',        
                        'total_restincharge_with_tax_top','total_restincharge_without_tax_top',                          
                        'total_sale_and_adder_with_tax',
                        'total_sale_and_adder_and_fee_with_tax',
                        'total_sale_and_adder_tax',    'subvention_type_id','work_id',                     
                        'pack_prime','ite_prime','taxes', 'discount_amount',     
                        'ana_prime','ana_pack_prime','number_of_parts',
                        'cee_prime','subvention','bbc_subvention','mode','passoire_subvention'
                    ) as $field)
        {
            $this->set($field,$quotation->get($field));
        }   
        $this->save();   
        $this->updateLastFromContract();                
     //   $this->set('reference',$this->loadReference());
        $this->save();
        // Delete old data 
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array( 'billing_id'=>$this->get('id')))                       
                ->setQuery("DELETE FROM ".DomoprimeBillingProduct::getTable().                           
                           " WHERE ".DomoprimeBillingProduct::getTableField('billing_id')." ='{billing_id}'".                                                              
                           ";")
                ->makeSiteSqlQuery($this->getSite());      
        
        $products=new DomoprimeBillingProductCollection(null,$this->getSite());
        foreach ($quotation->getProductsWithItems() as $index=>$product)
        {
            $item=new DomoprimeBillingProduct(null,$this->getSite());
            $item->set('billing_id',$this);
            $item->set('contract_id',$this->getContract());
            $item->createFromQuotationProduct($product);
            $products[$index]=$item;
        }                     
        $products->save();
      //  echo "<pre>"; var_dump($products); echo "</pre>"; 
        $items=new DomoprimeBillingProductItemCollection(null,$this->getSite());
     //   echo "<pre>"; var_dump($quotation->getProductsWithItems());
        foreach ($quotation->getProductsWithItems() as $index=>$product) // DomoprimeQuotationProduct
        {   
            foreach ($product->getItems() as $product_item )
            {
                $item=new DomoprimeBillingProductItem(null,$this->getSite());
                $item->set('billing_id',$this);           
                $item->set('billing_product_id',$products[$index]->get('id'));             
                $item->createFromQuotationItem($product_item);
                $items[]=$item;
            }            
        }    
        $items->save();
        return $this;
    }
    
     function getRestInChargeWithTax()
    {
        return $this->getRestInCharge();
    }
    
    
    static function getBillingsFromWorksForContract(CustomerContract $contract)
    {        
        $list = new DomoprimeBillingCollection(null,$contract->getSite());
           $db=mfSiteDatabase::getInstance()
                ->setParameters(array('contract_id'=>$contract->get('id')))      
                ->setObjects(array('DomoprimeBilling','DomoprimeCustomerContractWork'))
                ->setQuery("SELECT {fields} FROM ".DomoprimeBilling::getTable().
                           " INNER JOIN ".DomoprimeBilling::getOuterForJoin('work_id').
                           " WHERE ".DomoprimeBilling::getTableField('contract_id')."='{contract_id}' AND ".
                                    DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE' AND ".
                                    DomoprimeBilling::getTableFIeld('is_last')."='YES'".
                           ";")
                ->makeSiteSqlQuery($contract->getSite());    
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;
        while ($items=$db->fetchObjects())
        {        
            $item=$items->getDomoprimeBilling();
            $item->set('work_id',$items->getDomoprimeCustomerContractWork());
            $list[$item->get('id')]=$item;
        }
        $list->loaded();
        return $list;               
    }
    
     static function getBillingsFromWorksForMeeting(CustomerMeeting $meeting)
    {        
        $list = new DomoprimeBillingCollection(null,$meeting->getSite());
           $db=mfSiteDatabase::getInstance()
                ->setParameters(array('meeting_id'=>$meeting->get('id')))      
                ->setObjects(array('DomoprimeBilling','DomoprimeCustomerContractWork'))
                ->setQuery("SELECT {fields} FROM ".DomoprimeBilling::getTable().
                           " INNER JOIN ".DomoprimeBilling::getOuterForJoin('work_id').
                           " WHERE ".DomoprimeBilling::getTableField('meeting_id')."='{meeting_id}' AND ".
                                    DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE' AND ".
                                    DomoprimeBilling::getTableFIeld('is_last')."='YES'".
                           ";")
                ->makeSiteSqlQuery($meeting->getSite());    
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;
        while ($items=$db->fetchObjects())
        {        
            $item=$items->getDomoprimeBilling();
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
        return $this->getTotalSaleWithTax() - $this->getPackPrime() - $this->getAnaPackTax() - $this->getDiscountAmount();
    } 
     // total_sale_and_pack_prime_and_ana_pack_tax_discount 
    function getFormattedTotalSaleAndPackPrimeAndAnaPackWithTaxAndDiscount()
    {
        return format_currency($this->getTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTaxAndDiscount(),'EUR');
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
        return $this->formatter_api2=$this->formatter_api2===null?new DomoprimeBillingItemFormatterApi2($this,$options):$this->formatter_api2;
    }
    
     
    function getCalculation()
    {
        return $this->_calculation_id=$this->_calculation_id===null?new DomoprimeCalculation($this->get('calculation_id'),$this->getSite()):$this->_calculation_id;
    }
    
    static function getBillingByContract(CustomerContract $contract)
    {      
        static $value;
        if ($value!==null)
            return $value;
        $db=mfSiteDatabase::getInstance()
             ->setParameters(array('contract_id'=>$contract->get('id')))
             ->setQuery("SELECT * FROM ".self::getTable()." WHERE contract_id='{contract_id}'".
                        " ORDER BY id DESC".
                        " LIMIT 0,1".
                        ";")
            ->makeSiteSqlQuery($contract->getSite());         
        if (!$db->getNumRows())
            return false;         
        return $value=$db->fetchObject('DomoprimeBilling') ->loaded();
    }
    
    
    static function getBillingByMeeting(CustomerMeeting $meeting)
    {      
        static $value;
        if ($value!==null)
            return $value;
        $db=mfSiteDatabase::getInstance()
             ->setParameters(array('meeting_id'=>$meeting->get('id')))
             ->setQuery("SELECT ".self::getFieldsAndKeyWithTable()." FROM ".self::getTable().
                       " INNER JOIN ".self::getOuterForJoin('contract_id').
                       " WHERE ".CustomerContract::getTableFIeld('meeting_id')."='{meeting_id}'".
                       " ORDER BY id DESC".
                       " LIMIT 0,1".
                       ";")
            ->makeSiteSqlQuery($meeting->getSite());         
        if (!$db->getNumRows())
            return false;         
        return $value=$db->fetchObject('DomoprimeBilling') ->loaded();
    }
}
