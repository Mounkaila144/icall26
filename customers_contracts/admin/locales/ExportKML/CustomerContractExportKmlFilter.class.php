<?php

class CustomerContractExportKMLFilter extends CustomerContractExportKMLFilterBase {
    
     function execute()
    {     
         $this->objects=new mfArray(array('Customer','CustomerContract','CustomerAddress'));
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=> mfcontext::getInstance()->getUser()->getCountry()));
        
         if ($this->getOptions() && $this->getOptions()->isSavAtMode())
        {                      
            $this->_query->select("{fields}")
                    ->from(CustomerContract::getTable())
                    ->left(CustomerContract::getOuterForJoin('customer_id'))
                    ->left(CustomerAddress::getInnerForJoin('customer_id'))
                    ->where(CustomerAddress::getTableField('coordinates')."!='' ".
                              " AND sav_at!='' ".
                              " AND ".CustomerContract::getTableField('status')."='ACTIVE'".
                              $this->getFilter()->getWhere('AND').
                              $this->getFilter()->getConditions()->getWhere("AND"))
                    ->orderBy("sav_at ASC");
          /* $db->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " WHERE ".CustomerAddress::getTableField('coordinates')."!='' ".
                              " AND sav_at!='' ".
                              " AND ".CustomerContract::getTableField('status')."='ACTIVE'".
                              $this->getFilter()->getWhere('AND').
                              $this->getFilter()->getConditions()->getWhere("AND").  
                           " ORDER BY sav_at ASC".
                           ";") ;*/ 
        }   
        elseif ($this->getOptions() && $this->getOptions()->isSavAtRangeMode())
        {                   
            $this->getObjects()->push('CustomerContractRange')
                               ->push('CustomerContractRangeI18n');
            $this->_query->select("{fields}")
                    ->from(CustomerContract::getTable())
                    ->left(CustomerContract::getOuterForJoin('customer_id'))
                    ->left(CustomerAddress::getInnerForJoin('customer_id'))
                    ->left(CustomerContract::getOuterForJoin('sav_at_range_id'))
                    ->left(CustomerContractRangeI18n::getInnerForJoin('range_id')." AND ".CustomerContractRangeI18n::getTableField('lang')."='{lang}'")
                    ->where(CustomerAddress::getTableField('coordinates')."!='' ".
                              " AND sav_at!='' ".
                              " AND ".CustomerContract::getTableField('status')."='ACTIVE'".
                              $this->getFilter()->getWhere('AND').
                              $this->getFilter()->getConditions()->getWhere("AND"))
                    ->orderBy(CustomerContractRange::getTableField('from')." ASC");
            /* $db->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sav_at_range_id').  
                           " LEFT JOIN ".CustomerContractRangeI18n::getInnerForJoin('range_id')." AND ".CustomerContractRangeI18n::getTableField('lang')."='{lang}'".
                           " WHERE ".CustomerAddress::getTableField('coordinates')."!='' ".                             
                              " AND ".CustomerContract::getTableField('status')."='ACTIVE'".
                              $this->getFilter()->getWhere('AND').
                              $this->getFilter()->getConditions()->getWhere("AND").  
                           " ORDER BY ".CustomerContractRange::getTableField('from')." ASC".
                           ";") ;       */      
        }   
        elseif ($this->getOptions() && $this->getOptions()->isOpcAtMode())
        {                     
            $this->_query->select("{fields}")
                    ->from(CustomerContract::getTable())
                    ->left(CustomerContract::getOuterForJoin('customer_id'))
                    ->left(CustomerAddress::getInnerForJoin('customer_id'))
                    ->where(CustomerAddress::getTableField('coordinates')."!='' ".
                              " AND opc_at!='' ".
                              " AND ".CustomerContract::getTableField('status')."='ACTIVE'".
                              $this->getFilter()->getWhere('AND').
                              $this->getFilter()->getConditions()->getWhere("AND"))
                    ->orderBy("sav_at ASC");
          /* $db->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " WHERE ".CustomerAddress::getTableField('coordinates')."!='' ".
                              " AND opc_at!='' ".
                              " AND ".CustomerContract::getTableField('status')."='ACTIVE'".
                              $this->getFilter()->getWhere('AND').
                              $this->getFilter()->getConditions()->getWhere("AND").  
                           " ORDER BY opc_at ASC".
                           ";") ; */
        }   
        elseif ($this->getOptions() && $this->getOptions()->isOpcRangeMode())
        {                     
            $this->getObjects()->push('CustomerContractRange')
                               ->push('CustomerContractRangeI18n');
            $this->_query->select("{fields}")
                    ->from(CustomerContract::getTable())
                    ->left(CustomerContract::getOuterForJoin('customer_id'))
                    ->left(CustomerAddress::getInnerForJoin('customer_id'))
                    ->left(CustomerContract::getOuterForJoin('opc_range_id'))
                    ->left(CustomerContractRangeI18n::getInnerForJoin('range_id')." AND ".CustomerContractRangeI18n::getTableField('lang')."='{lang}'")
                    ->where(CustomerAddress::getTableField('coordinates')."!='' ".
                              " AND opc_at!='' ".
                              " AND ".CustomerContract::getTableField('status')."='ACTIVE'".
                              $this->getFilter()->getWhere('AND').
                              $this->getFilter()->getConditions()->getWhere("AND"))
                    ->orderBy(CustomerContractRange::getTableField('from')." ASC");
          /*  $db->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('opc_range_id').  
                           " LEFT JOIN ".CustomerContractRangeI18n::getInnerForJoin('range_id')." AND ".CustomerContractRangeI18n::getTableField('lang')."='{lang}'".
                           " WHERE ".CustomerAddress::getTableField('coordinates')."!='' ".                             
                              " AND ".CustomerContract::getTableField('status')."='ACTIVE'".
                              $this->getFilter()->getWhere('AND').
                              $this->getFilter()->getConditions()->getWhere("AND").  
                           " ORDER BY ".CustomerContractRange::getTableField('from')." ASC".
                           ";") ;   */          
        }   
        else
        {                        
             $this->_query->select("{fields}")
                    ->from(CustomerContract::getTable())
                    ->left(CustomerContract::getOuterForJoin('customer_id'))
                    ->left(CustomerAddress::getInnerForJoin('customer_id'))
                    ->where( //CustomerAddress::getTableField('coordinates')."!='' ".                        
                              CustomerContract::getTableField('status')."='ACTIVE'".
                              $this->getFilter()->getWhere('AND').
                              $this->getFilter()->getConditions()->getWhere("AND"))
                    ->orderBy("opened_at ASC");
           /* $db->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " WHERE ".CustomerAddress::getTableField('coordinates')."!='' ".
                           " AND ".CustomerContract::getTableField('status')."='ACTIVE'".
                           $this->getFilter()->getWhere('AND').
                           $this->getFilter()->getConditions()->getWhere("AND").  
                           " ORDER BY opened_at ASC".
                           ";") ; */
        }           
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contract.filter.kml.config'));  
        $db->setObjects($this->getObjects()->toArray());
        $db->setQuery((string)$this->_query);
        $db->makeSqlQuery();     
        $this->number_of_items=$db->getNumRows();    
       // echo $db->getQuery();
       // trigger_error($db->getQuery());     
        $this->getItemsFromDatabase($db);    
    }
}

 