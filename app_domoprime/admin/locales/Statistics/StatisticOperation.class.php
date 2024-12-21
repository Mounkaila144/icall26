<?php


class StatisticOperation extends StatisticSheet {
    
    protected $lang=null,$conditions=null;
   
    function __construct($user) {
         parent::__construct();           
         $this->lang=  $user->getCountry();        
         $this->user=$user;         
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getNames()
    {
        return array('number_of_contracts','number_of_operations','number_of_cumacs','cumac_top','cumac_wall','cumac_floor',
                     'number_of_surface','surface_top','surface_wall','surface_floor'
        );
    }
    
    function setConditions($conditions)
    {
        $this->conditions=$conditions;        
        return $this;
    }
    
     function summarize()
    {
        $this->rows['total']=new StatisticRow(__('Total'));
        foreach ($this->rows as $index=>$row)
        {
           if ($index=='total')
               continue;
           foreach ($row->getColumns() as $name=>$column)
           {              
               if ($column)
               {
                 $this->rows['total']->columns[$name]+=$column->getValue();
               }
           }               
        }  
    }
    
    function execute()
    {                        
        // Load status
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=>$this->lang))
                ->setObjects(array('CustomerContractStatusI18n','CustomerContractStatus'))
                ->setQuery("SELECT {fields} FROM ".CustomerContractStatus::getTable().
                           " INNER JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id'). " AND lang='{lang}'". 
                           " ORDER BY ".CustomerContractStatusI18n::getTableField('value')." ASC".
                           ";")                                                        
                ->makeSqlQuery(); 
        if (!$db->getNumRows())
            return array();           
        $this->rows=new mfArray();
        $this->rows['state']=new StatisticRow(null);
        foreach ($this->getNames()as $name)
            $this->rows['state']->columns[$name]=0.0;
        while ($item=$db->fetchObjects())
        {
            $item->getCustomerContractStatus()->setCustomerContractStatusI18n($item->getCustomerContractStatusI18n());
            $this->rows[$item->getCustomerContractStatus()->get('id')]=new StatisticRow($item->getCustomerContractStatus());
            foreach ($this->getNames()as $name)
                $this->rows[$item->getCustomerContractStatus()->get('id')]->columns[$name]=0.0;           
        }  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($this->conditions->getParameters())             
                ->setQuery("SELECT ".
                                " COUNT(".CustomerContract::getTableField('id').") as `number_of_contracts`,".                                                               
                                CustomerContract::getTableField('state_id').     
                           " FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').                
                           " INNER JOIN ".CustomerAddress::getInnerForJoin('customer_id').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').   
                        //   " LEFT JOIN ". DomoprimeCalculation::getInnerForJoin('contract_id').                           
                           " WHERE ".CustomerContract::getTableField('status')."='ACTIVE' ".
                              //      DomoprimeCalculation::getTableField('isLast')."='YES' ".                                    
                            $this->conditions->getWhere("AND").                        
                           " GROUP BY ".CustomerContractStatus::getTableField('id').
                                        
                           ";")                                                        
                ->makeSqlQuery();   
    //  echo $db->getQuery();
        
        if ($db->getNumRows())
        {    
            while ($row=$db->fetchArray())
            {            
                if (isset($this->rows[$row['state_id']]))
                {
                   $this->rows[$row['state_id']]->columns['number_of_contracts']=new FloatFormatter($row['number_of_contracts']);
                }                    
            }     
        }                
        $db=mfSiteDatabase::getInstance()
                ->setParameters($this->conditions->getParameters())             
                ->setQuery("SELECT ".
                                " COUNT(".DomoprimeProductCalculation::getTableField('id').") as `number_of_operations`,".                                                               
                                CustomerContract::getTableField('state_id').     
                           " FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').                
                           " INNER JOIN ".CustomerAddress::getInnerForJoin('customer_id').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').   
                           " LEFT JOIN ". DomoprimeCalculation::getInnerForJoin('contract_id').
                           " LEFT JOIN ". DomoprimeProductCalculation::getInnerForJoin('calculation_id').
                           " WHERE ".CustomerContract::getTableField('status')."='ACTIVE' AND ".
                                    DomoprimeCalculation::getTableField('isLast')."='YES' AND ".
                                    DomoprimeProductCalculation::getTableField('surface')." > 0".
                            $this->conditions->getWhere("AND").                        
                           " GROUP BY ".CustomerContractStatus::getTableField('id').
                                        
                           ";")                                                        
                ->makeSqlQuery(); 
      //  echo $db->getQuery();
        if ($db->getNumRows())
        {    
            while ($row=$db->fetchArray())
            {            
                if (isset($this->rows[$row['state_id']]))
                {
                   $this->rows[$row['state_id']]->columns['number_of_operations']=new FloatFormatter($row['number_of_operations']);
                }                    
            }     
        }
       // Cumac + surface
        $db=mfSiteDatabase::getInstance()
                ->setParameters($this->conditions->getParameters())             
                ->setQuery("SELECT ".
                                " SUM(".DomoprimeProductCalculation::getTableField('qmac').") as `number_of_cumacs`,".                                                               
                                " SUM(".DomoprimeProductCalculation::getTableField('surface').") as `number_of_surface`,".
                                CustomerContract::getTableField('state_id').     
                           " FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').                
                           " INNER JOIN ".CustomerAddress::getInnerForJoin('customer_id').
                           " LEFT JOIN ". DomoprimeCalculation::getInnerForJoin('contract_id').
                           " LEFT JOIN ". DomoprimeProductCalculation::getInnerForJoin('calculation_id').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').                            
                           " WHERE ".CustomerContract::getTableField('status')."='ACTIVE' AND ".
                                            DomoprimeCalculation::getTableField('isLast')."='YES'".
                            $this->conditions->getWhere("AND").                        
                           " GROUP BY ".CustomerContractStatus::getTableField('id').                                      
                           ";")                                                        
                ->makeSqlQuery();
        if ($db->getNumRows())        
        {    
            while ($row=$db->fetchArray())
            {            
                if (isset($this->rows[$row['state_id']]))
                {
                   $this->rows[$row['state_id']]->columns['number_of_cumacs']=new FloatFormatter($row['number_of_cumacs']);
                   $this->rows[$row['state_id']]->columns['number_of_surface']=new FloatFormatter($row['number_of_surface']);
                }                    
            }   
        }
        // 101 + 102 + 103
        $db=mfSiteDatabase::getInstance()
                ->setParameters($this->conditions->getParameters())             
                ->setQuery("SELECT ".                                                                                          
                                " SUM(".DomoprimeProductCalculation::getTableField('surface').") as `number_of_surface`".
                                ", SUM(".DomoprimeProductCalculation::getTableField('qmac').") as `number_of_cumacs`".
                                ",".CustomerContract::getTableField('state_id'). 
                                ",".DomoprimeProductCalculation::getTableField('product_id').
                           " FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').                
                           " INNER JOIN ".CustomerAddress::getInnerForJoin('customer_id').
                           " LEFT JOIN ". DomoprimeCalculation::getInnerForJoin('contract_id').
                           " LEFT JOIN ". DomoprimeProductCalculation::getInnerForJoin('calculation_id').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').                            
                           " WHERE ".CustomerContract::getTableField('status')."='ACTIVE' AND ".
                                    DomoprimeCalculation::getTableField('isLast')."='YES'".
                            $this->conditions->getWhere("AND").                        
                           " GROUP BY ".CustomerContractStatus::getTableField('id').
                                      ",".DomoprimeProductCalculation::getTableField('product_id').
                           ";")                                                        
                ->makeSqlQuery();   
     //   echo $db->getQuery();
        if ($db->getNumRows())
        {    
            $product_surface=DomoprimeSettings::load()->getTypeNamesForProducts();
            while ($row=$db->fetchArray())
            {                           
                if (isset($this->rows[$row['state_id']]))
                {
                   $this->rows[$row['state_id']]->columns["surface_".$product_surface[$row['product_id']]]=new FloatFormatter($row['number_of_surface']);                 
                   $this->rows[$row['state_id']]->columns["cumac_".$product_surface[$row['product_id']]]=new FloatFormatter($row['number_of_cumacs']);                 
                }                    
            }
        }
        
      
        
        
        $this->summarize();
    }
      
       
}


