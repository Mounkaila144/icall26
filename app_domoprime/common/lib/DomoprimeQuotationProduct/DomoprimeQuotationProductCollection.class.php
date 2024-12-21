<?php


class DomoprimeQuotationProductCollection extends mfObjectCollection2 {
        
     protected $contract=null;
    
    public function __construct($data=null,$site=null) {
        if ($data instanceof CustomerContract)
        {    
            $this->contract=$data;
            return parent::__construct(null,$data->getSite());
        }
        parent::__construct($data,$site);
    }
    
    function getContract()
    {
        return $this->contract;
    }
    
     
    protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSiteSqlQuery($this->site);   
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site); 
    }
    
    
    function getTotalSaleWithoutTax()
    {
        if ($this->total_sale_without_tax===null)
        {
            $this->total_sale_without_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_sale_without_tax+=$item->getTotalSalePriceWithoutTax();
        }    
        return $this->total_sale_without_tax;
    }
    
     function getTotalSaleWithTax()
    {
        if ($this->total_sale_with_tax===null)
        {
            $this->total_sale_with_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_sale_with_tax+=$item->getTotalSalePriceWithTax();
        }    
        return $this->total_sale_with_tax;
    }
    
    
    function getTotalPurchaseWithoutTax()
    {
        if ($this->total_purchase_without_tax===null)
        {
            $this->total_purchase_without_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_purchase_without_tax+=$item->getTotalPurchasePriceWithoutTax();
        }    
        return $this->total_purchase_without_tax;
    }
    
     function getTotalPurchaseWithTax()
    {
        if ($this->total_purchase_with_tax===null)
        {
            $this->total_purchase_with_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_purchase_with_tax+=$item->getTotalPurchasePriceWithTax();
        }    
        return $this->total_purchase_with_tax;
    }
    
    function getFormattedTotalSaleWithTax()
    {
        return format_currency($this->getTotalSaleWithTax(),'EUR');
    }
    
    function getFormattedTotalSaleWithoutTax()
    {
        return format_currency($this->getTotalSaleWithoutTax(),'EUR');
    }
       
    
    function toArrayForQuotation()
    {        
        $product_surface=DomoprimeSettings::load($this->getSite())->getTypeNamesForProducts();   
        $values=array();
        foreach (array('input1','input4','mark','description','reference','unit',
                        'input2','thickness','input3','content','details',
                        'input5','input6','input7','unit') as $field)
        {
              $values[$field]=array();
        }          
        //$values=array('input1'=>array(),'description'=>array(),'mark'=>array());
        
        foreach ($this->collection as $item)
        {
             if ($product_surface[$item->get('product_id')])
                $values[$product_surface[$item->get('product_id')]]=$item->toArrayForQuotation();
             else
                $values[]=$item->toArrayForQuotation();
        }              
        foreach ($this->collection as $product)
        {                                              
            foreach ($product->getItems()->getMasters() as $item)
            {          
                //$values['is_master']=true;
                foreach (array('input1','input4','mark','description','reference',
                               'input2','thickness','input3','content','details',
                               'input5','input6','input7') as $field)
                {                    
                    $values[$field][]=$item->getProductItem()->get($field);     
                }
               /* $values['input1'][]=$item->getProductItem()->get('input1');
                $values['input4'][]=$item->getProductItem()->get('input4');
                $values['mark'][]=$item->getProductItem()->get('mark');
                $values['description'][]=$item->getProductItem()->get('description');*/
            }    
        }    
        return $values;
    }
            
    function getByProducts()
    {
        $values=new mfArray();
        foreach ($this->collection as $item)
        {
            $values[$item->get('product_id')]=$item;
        }   
        return $values;
    }
    
    
     function getTotalDiscountSaleWithoutTax()
    {
        if ($this->total_sale_discount_without_tax===null)
        {
            $this->total_sale_discount_without_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_sale_discount_without_tax+=$item->getTotalSaleDiscountPriceWithoutTax();
        }    
        return $this->total_sale_discount_without_tax;
    }
    
     function getTotalDiscountSaleWithTax()
    {
        if ($this->total_sale_discount_with_tax===null)
        {
            $this->total_sale_discount_with_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_sale_discount_with_tax+=$item->getTotalSaleDiscountPriceWithTax();
        }    
        return $this->total_sale_discount_with_tax;
    }
    
    
    function toArrayForPackBoilerQuotation()
    {                  
        $values=array();        
        foreach ($this->collection as $product)
        {    
            foreach ($product->getItems() as  $item)
            {                     
                if ($item->getProductItem()->get('input3'))
                {                      
                    $values['thermal']=$item->getProductItem()->get('input3');
                    return $values;
                }
            }            
        }              
        return $values;
    }
    
    
    function hasMaster()
    {
        return $this->getMaster();
    }
    
    function getMaster()
    {      
        if ($this->master===null)
        {    
            foreach ($this->collection as $product)
            {    
                foreach ($product->getItems() as  $item)
                {    
                    if ($item->get('is_master')=='YES')
                    {
                        $this->master= $item;
                        return $this->master;
                    }
                }            
            }
            $this->master=false;
        }        
        return $this->master;                 
    }
    
    
    function getQuotationItems()
    {
        if ($this->items===null)
        {
            $this->items= new DomoprimeQuotationProductItemCollection(null,$this->getSite());
            foreach ($this as $product)
            {
                foreach ($product->getItems() as $item)
                    $this->items[$item->get('id')]=$item;
            }    
        }  
        return $this->items;
    }
    
    
    
    function getAll()
    {       
          if ($this->isNotLoaded())
        {    
           if ($this->contract===null)
               return $this;
           if ($this->contract->hasPolluter())
           {
                $db=mfSiteDatabase::getInstance()
                       ->setParameters(array('contract_id'=>$this->getContract()->get('id')))
                       ->setObjects(array('DomoprimeQuotationProduct','Product'))
                       ->setQuery("SELECT {fields} FROM ".DomoprimeQuotationProduct::getTable().
                                  " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('quotation_id').
                                  " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('product_id').                               
                                  " WHERE ".DomoprimeQuotation::getTableField('contract_id')."='{contract_id}' AND ".DomoprimeQuotation::getTableField('is_last')."='YES' AND ".
                                            DomoprimeQuotation::getTableField('mode')."='multiple' ".                                          
                                  ";")
                       ->makeSiteSqlQuery($this->getSite());    
               // echo $db->getQuery();                  
           }   
           else
           {    
                $db=mfSiteDatabase::getInstance()
                       ->setParameters(array('contract_id'=>$this->getCOntract()->get('id')))
                       ->setObjects(array('DomoprimeQuotationProduct','Product'))
                       ->setQuery("SELECT {fields} FROM ".DomoprimeQuotationProduct::getTable().
                                  " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('quotation_id').
                                  " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('product_id').
                                  " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('work_id'). 
                                  " WHERE ".DomoprimeQuotation::getTableField('contract_id')."='{contract_id}' AND ".DomoprimeQuotation::getTableField('is_last')."='YES' AND ".
                                            DomoprimeQuotation::getTableField('mode')."='simple' AND ".
                                            DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE'".
                                  ";")
                       ->makeSiteSqlQuery($this->getSite());    
               // echo $db->getQuery();                  
           }
            if (!$db->getNumRows())
                      return $this;
            while ($items=$db->fetchObjects())
            {                           
                $item=$items->getDomoprimeQuotationProduct();                  
                $item->set('product_id',$items->getProduct());       
                $this[$item->get('id')]=$item;
            }
            $this->loaded();
        }
        return $this;
    }
    
    
    function getProducts()
    {
        if ($this->products===null)
        {
            $this->products=new ProductCollection(null,$this->getSite());
            foreach ($this as $item)
              $this->products[$item->get('product_id')]=$item->getProduct();
        }   
        return $this->products;
    }
    /*
     SELECT count(*) FROM t_domoprime_quotation_product 
INNER JOIN t_domoprime_quotation ON t_domoprime_quotation.id=t_domoprime_quotation_product.quotation_id  
INNER JOIN t_domoprime_multi_customer_work ON t_domoprime_multi_customer_work.id=t_domoprime_quotation_product.work_id 
LEFT JOIN (SELECT t_domoprime_calculation.id as calculation_id,t_domoprime_product_calculation.product_id as calculation_product_id,t_domoprime_product_calculation.work_id as calculation_work_id FROM t_domoprime_product_calculation 
INNER JOIN t_domoprime_calculation ON t_domoprime_calculation.id=t_domoprime_product_calculation.calculation_id
INNER JOIN t_domoprime_multi_customer_work ON t_domoprime_multi_customer_work.id=t_domoprime_product_calculation.work_id 
WHERE t_domoprime_calculation.contract_id='4' AND t_domoprime_calculation.isLast='YES' 
AND t_domoprime_multi_customer_work.status='ACTIVE') as calculation ON calculation.calculation_work_id = t_domoprime_quotation_product.work_id
WHERE t_domoprime_quotation.contract_id='4' AND t_domoprime_quotation.is_last='YES' 
AND t_domoprime_multi_customer_work.status='ACTIVE' AND calculation.calculation_id IS NULL
     */
    
    function isModified()
    {              
        if ($this->is_modified===null)
        {    
           if ($this->getContract())
           {    
               if ($this->getContract()->hasPolluter())
               {
                   $this->is_modified=true;
                    // changement de products dans devis -> calcul
                  /*  $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('contract_id'=>$this->getContract()->get('id')))             
                         ->setQuery("SELECT COUNT(*) FROM ".DomoprimeQuotationProduct::getTable().
                                    " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('quotation_id').                                                         
                                    " LEFT JOIN (".
                                              " SELECT ".DomoprimeProductCalculation::getTableField('id')." as calculation_id,".DomoprimeCalculation::getTableField('contract_id')." as calculation_contract_id ".
                                              " FROM ".DomoprimeProductCalculation::getTable().
                                              " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('calculation_id').                                           
                                              " WHERE ".DomoprimeCalculation::getTableField('contract_id')."='{contract_id}' ".
                                                            " AND ".DomoprimeCalculation::getTableField('isLast')."='YES' ".
                                                            " AND ". DomoprimeQuotation::getTableField('mode')."='multiple'".
                                                      //  DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE'".
                                               ") as calculation ON  calculation.calculation_contract_id =". DomoprimeQuotationProduct::getTableField('contract_id').
                                    " WHERE ".DomoprimeQuotation::getTableField('contract_id')."='{contract_id}' AND ".DomoprimeQuotation::getTableField('is_last')."='YES' ".
                                              " AND ".DomoprimeQuotation::getTableField('mode')."='multiple' ".
                                              " AND ".DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE' ".
                                              " AND calculation.calculation_id IS NULL".                         
                                    ";")
                         ->makeSiteSqlQuery($this->getSite()); 
                     // echo $db->getQuery()."<br/>";          
                     $row=$db->fetchRow();                 
                     if ($row[0] !=0) 
                     {
                          return $this->is_modified=true;               
                     }   
                     $db=mfSiteDatabase::getInstance()
                    ->setParameters(array('contract_id'=>$this->getContract()->get('id')))             
                    ->setQuery("SELECT COUNT(*) FROM ".DomoprimeProductCalculation::getTable().
                               " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('calculation_id').                                                  
                               " LEFT JOIN (".
                                         " SELECT ".DomoprimeQuotationProduct::getTableField('id')." as quotation_id,".DomoprimeQuotation::getTableField('contract_id')." as quotation_contract_id ".
                                         " FROM ".DomoprimeQuotationProduct::getTable().
                                         " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('quotation_id').                                       
                                         " WHERE ".DomoprimeQuotation::getTableField('contract_id')."='{contract_id}' AND ".DomoprimeQuotation::getTableField('is_last')."='YES' ".
                                                   " AND ". DomoprimeQuotation::getTableField('mode')."='multiple'".                                                
                                          ") as quotation ON  quotation.quotation_contract_id =". DomoprimeCalculation::getTableField('contract_id').
                               " WHERE ".DomoprimeCalculation::getTableField('contract_id')."='{contract_id}' AND ".DomoprimeCalculation::getTableField('isLast')."='YES' ".
                                         " AND ". DomoprimeQuotation::getTableField('mode')."='multiple'".
                                         " AND quotation.quotation_id IS NULL".                         
                               ";")
                    ->makeSiteSqlQuery($this->getSite()); 
               // echo $db->getQuery()."<br/>";          
                $row=$db->fetchRow();                 
                if ($row[0] !=0) 
                {
                     return $this->is_modified=true;               
                }   
                // pas de changement de produits -> check changement de quantity  
             /*  $db=mfSiteDatabase::getInstance()
                  ->setParameters(array('contract_id'=>$this->getCOntract()->get('id')))              
                  ->setQuery("SELECT SUM(tmp.number_of_products) FROM (".                       
                               "SELECT SUM(".DomoprimeProductCalculation::getTableField('surface')."!=".
                                            DomoprimeQuotationProduct::getTableField('quantity').") as number_of_products".
                               " FROM ".DomoprimeProductCalculation::getTable().
                               " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('calculation_id').
                               " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('product_id').
                          
                               " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('work_id'). 
                               " INNER JOIN ".DomoprimeQuotationProduct::getInnerForJoin('work_id'). 
                               " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('quotation_id').  
                               " WHERE ".DomoprimeCalculation::getTableField('contract_id')."='{contract_id}' AND ".DomoprimeCalculation::getTableField('isLast')."='YES' ".
                                         " AND ".DomoprimeQuotation::getTableField('is_last')."='YES' ".
                                         " AND ".DomoprimeQuotation::getTableField('mode')."='multiple'".                                           
                               " GROUP BY ".DomoprimeCustomerContractWork::getTableField('id').
                                 ") as tmp".
                             ";")
                  ->makeSiteSqlQuery($this->getSite()); 
             //  echo $db->getQuery();
               $row=$db->fetchRow();

               return $this->is_modified = ($row[0] > 0);*/
               
                
                
                
                
                 
                
                
                
                
                
                
               }    
               else
               {    
            // changement de products dans devis -> calcul
               $db=mfSiteDatabase::getInstance()
                    ->setParameters(array('contract_id'=>$this->getContract()->get('id')))             
                    ->setQuery("SELECT COUNT(*) FROM ".DomoprimeQuotationProduct::getTable().
                               " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('quotation_id').                        
                               " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('work_id'). 
                               " LEFT JOIN (".
                                         " SELECT ".DomoprimeProductCalculation::getTableField('id')." as calculation_id,".DomoprimeProductCalculation::getTableField('work_id')." as calculation_work_id ".
                                         " FROM ".DomoprimeProductCalculation::getTable().
                                         " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('calculation_id').
                                         " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('work_id'). 
                                         " WHERE ".DomoprimeCalculation::getTableField('contract_id')."='{contract_id}' AND ".DomoprimeCalculation::getTableField('isLast')."='YES' ".
                                                     " AND ". DomoprimeQuotation::getTableField('mode')."='simple'".
                                                 //  DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE'".
                                          ") as calculation ON  calculation.calculation_work_id =". DomoprimeQuotationProduct::getTableField('work_id').
                               " WHERE ".DomoprimeQuotation::getTableField('contract_id')."='{contract_id}' AND ".DomoprimeQuotation::getTableField('is_last')."='YES' AND ".
                                         DomoprimeQuotation::getTableField('mode')."='simple'".
                                         DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE' AND ".
                                         " calculation.calculation_id IS NULL".                         
                               ";")
                    ->makeSiteSqlQuery($this->getSite()); 
                // echo $db->getQuery()."<br/>";          
                $row=$db->fetchRow();                 
                if ($row[0] !=0) 
                {
                     return $this->is_modified=true;               
                }            

                $db=mfSiteDatabase::getInstance()
                    ->setParameters(array('contract_id'=>$this->getContract()->get('id')))             
                    ->setQuery("SELECT COUNT(*) FROM ".DomoprimeProductCalculation::getTable().
                               " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('calculation_id').                        
                               " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('work_id'). 
                               " LEFT JOIN (".
                                         " SELECT ".DomoprimeQuotationProduct::getTableField('id')." as quotation_id,".DomoprimeQuotationProduct::getTableField('work_id')." as quotation_work_id ".
                                         " FROM ".DomoprimeQuotationProduct::getTable().
                                         " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('quotation_id').
                                         " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('work_id'). 
                                         " WHERE ".DomoprimeQuotation::getTableField('contract_id')."='{contract_id}' AND ".DomoprimeQuotation::getTableField('is_last')."='YES' AND ".
                                                   DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE'".
                                          ") as quotation ON  quotation.quotation_work_id =". DomoprimeProductCalculation::getTableField('work_id').
                               " WHERE ".DomoprimeCalculation::getTableField('contract_id')."='{contract_id}' AND ".DomoprimeCalculation::getTableField('isLast')."='YES' AND ".
                                      //   DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE' AND ".
                                         " quotation.quotation_id IS NULL".                         
                               ";")
                    ->makeSiteSqlQuery($this->getSite()); 
               // echo $db->getQuery()."<br/>";          
                $row=$db->fetchRow();                 
                if ($row[0] !=0) 
                {
                     return $this->is_modified=true;               
                }               
           // pas de changement de produits -> check changement de quantity  
               $db=mfSiteDatabase::getInstance()
                  ->setParameters(array('contract_id'=>$this->getCOntract()->get('id')))              
                  ->setQuery("SELECT SUM(tmp.number_of_products) FROM (".                       
                               "SELECT SUM(".DomoprimeProductCalculation::getTableField('surface')."!=".
                                            DomoprimeQuotationProduct::getTableField('quantity').") as number_of_products".
                               " FROM ".DomoprimeProductCalculation::getTable().
                               " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('calculation_id').
                               " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('product_id').
                               " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('work_id'). 
                               " INNER JOIN ".DomoprimeQuotationProduct::getInnerForJoin('work_id'). 
                               " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('quotation_id').  
                               " WHERE ".DomoprimeCalculation::getTableField('contract_id')."='{contract_id}' AND ".DomoprimeCalculation::getTableField('isLast')."='YES' AND ".
                                         DomoprimeQuotation::getTableField('is_last')."='YES' AND ".
                                         DomoprimeCustomerContractWork::getTableField('status')."='ACTIVE'".
                               " GROUP BY ".DomoprimeCustomerContractWork::getTableField('id').
                                 ") as tmp".
                             ";")
                  ->makeSiteSqlQuery($this->getSite()); 
             //  echo $db->getQuery();
               $row=$db->fetchRow();

               return $this->is_modified = ($row[0] > 0);
               }
           }
        }
        return $this->is_modified;
    }
    
    
    function toArrayForQuotationApi2()
    {        
        $product_surface=DomoprimeSettings::load($this->getSite())->getTypeNamesForProducts();   
        $values=array();
     /*   foreach (array('input1','input4','mark','description','reference','unit',
                        'input2','thickness','input3','content','details',
                        'input5','input6','input7','unit') as $field)
        {
              $values[$field]=array();
        }      */           
        foreach ($this->collection as $item)
        {
             if ($product_surface[$item->get('product_id')])
                $values[$product_surface[$item->get('product_id')]]=$item->toArrayForApi2();
             else
                $values[]=$item->toArrayForApi2();
        }              
      /*  foreach ($this->collection as $product)
        {                                              
            foreach ($product->getItems()->getMasters() as $item)
            {          
                //$values['is_master']=true;
                foreach (array('input1','input4','mark','description','reference',
                               'input2','thickness','input3','content','details',
                               'input5','input6','input7') as $field)
                {                    
                    $values[$field][]=$item->getProductItem()->get($field);     
                }            
            }    
        }  */  
        return $values;
    }
    
    function toArrayForHook()
    {
        $product_surface=DomoprimeSettings::load($this->getSite())->getTypeNamesForProducts();  
        $values=new mfArray();
        foreach ($this->collection as $item)
        {
            // if ($product_surface[$item->get('product_id')])
           //     $values[$product_surface[$item->get('product_id')]]=$item->toArrayForHook();
            // else
                $values[]=$item->toArrayForHook();
        }     
         return $values;
    }
}

