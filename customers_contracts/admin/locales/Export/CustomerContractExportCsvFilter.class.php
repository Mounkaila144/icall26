<?php

class CustomerContractExportCsvFilter extends CustomerContractExportCsvFilterBase {
    
    function execute()
    {           
         $this->getMfQuery()->select("{fields}")
                     ->select("(SELECT GROUP_CONCAT(UPPER(meta_title) ORDER BY meta_title SEPARATOR ',') FROM ".Product::getTable().
                                   " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('product_id').
                                   " WHERE ".CustomerContractProduct::getTableField('contract_id')."=".CustomerContract::getTableField('id').
                                  ") as products ")
                    ->from(CustomerContract::getTable())
                    ->left(CustomerContract::getOuterForJoin('customer_id'))
                    ->left(CustomerAddress::getInnerForJoin('customer_id'))
                    ->left(CustomerContract::getOuterForJoin('telepro_id','telepro'))
                    ->left(CustomerContract::getOuterForJoin('sale_1_id','sale1'))
                    ->left(CustomerContract::getOuterForJoin('sale_2_id','sale2'))
                    ->left(CustomerContract::getOuterForJoin('assistant_id','assistant'))
                    ->left(CustomerContract::getOuterForJoin('state_id'))
                    ->left(CustomerContractProduct::getInnerForJoin('contract_id'))
                    ->left(CustomerContract::getOuterForJoin('financial_partner_id'))
                    ->left(CustomerContract::getOuterForJoin('team_id'))                         
                    ->left(CustomerContractStatusI18n::getInnerForJoin('status_id')." AND ".CustomerContractStatusI18n::getTableField('lang')."='{lang}'")
                    ->where($this->getFilter()->getWhere())
                    ->where(CustomerContract::getTableField('status')."!='INPROGRESS'")
                    ->groupBy(CustomerContract::getTableField('id'))
                    ->orderBy(CustomerContract::getTableField('opened_at ASC'));
        
      //  echo $this->getMfQuery();
         mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contract.export.filter.config'));                     
         // echo (string)$this->getMfQuery();   die(__METHOD__);
        $db=new mfSiteDatabase(); // Mandatory if other queries requested on filter
            $db->setParameters(array('lang'=>$this->getOption('lang'),'user_id'=>$this->getUser()->getGuardUser()->get('id')))
                ->setObjects($this->getObjects()->toArray())
                ->setAlias($this->getAlias()->toArray())
                 ->setQuery((string)$this->getMfQuery())
               /* ->setQuery("SELECT {fields} ".
                                ",(SELECT GROUP_CONCAT(UPPER(meta_title) ORDER BY meta_title SEPARATOR ',') FROM ".Product::getTable().
                                   " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('product_id').
                                   " WHERE ".CustomerContractProduct::getTableField('contract_id')."=".CustomerContract::getTableField('id').
                                  ") as products ".
                           " FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('telepro_id','telepro'). 
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_1_id','sale1'). 
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_2_id','sale2').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('financial_partner_id'). 
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('team_id').                          
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('tax_id').
                           " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id'). 
                           " LEFT JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id')." AND ".CustomerContractStatusI18n::getTableField('lang')."='{lang}'".  
                           //" WHERE ".                        
                        //   $this->getFilter()->getConditions()->getWhere("AND").  
                           ($this->getFilter()->hasWhere()?" WHERE ".$this->getFilter()->getWhere():"").
                           " GROUP BY ".CustomerContract::getTableField('id').
                           " ORDER BY opened_at ASC".
                           ";")               */
                ->makeSqlQuery(); 
        $this->number_of_items=$db->getNumRows();       
         //echo $db->getQuery();  die(__METHOD__);
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);    
        $this->close();
    }
    
   
}