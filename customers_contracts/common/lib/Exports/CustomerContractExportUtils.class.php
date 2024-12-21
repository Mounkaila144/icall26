<?php

class CustomerContractExportUtils {
  
    
      static function getLayers($collection)
    {               
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('PartnerLayerCompany'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".PartnerLayerCompany::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('partner_layer_id').                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($collection[$items->get('contract_id')]))
               continue;                     
           $collection[$items->get('contract_id')]['PartnerLayerCompany']=$items->getPartnerLayerCompany();
        }        
    }   
    
     static function getCompanies($collection)
    {        
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('CustomerContractCompany'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContractCompany::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('company_id').                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($collection[$items->get('contract_id')]))
               continue;           
           $collection[$items->get('contract_id')]['CustomerContractCompany']=$items->getCustomerContractCompany();
        }        
    }
    
    static function getPolluters($collection)
    {       
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('PartnerPolluterCompany'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".PartnerPolluterCompany::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('polluter_id').                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($collection[$items->get('contract_id')]))
               continue;           
           $collection[$items->get('contract_id')]['PartnerPolluterCompany']=$items->getPartnerPolluterCompany();
        }        
    }
    
    static function getUsers($field,$name,$collection)
    {       
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())              
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable().",".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin($field).                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($item=$db->fetchObject('User'))
        {                   
           if (!isset($collection[$item->get('contract_id')]))
               continue;           
           $collection[$item->get('contract_id')][$name]=$item;
        }        
    }
    
    static function getTeams($collection)
    {       
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())              
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable().",".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('team_id').                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($item=$db->fetchObject('UserTeam'))
        {                   
           if (!isset($collection[$item->get('contract_id')]))
               continue;           
           $collection[$item->get('contract_id')]['UserTeam']=$item;
        }        
    }
    
    static function getStates($collection)
    {       
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getLanguage()))    
                ->setObjects(array('CustomerContractStatusI18n','CustomerContractStatus'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('state_id'). 
                           " INNER JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                                " AND lang='{lang}'".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($collection[$items->get('contract_id')]))
               continue;           
           $collection[$items->get('contract_id')]['CustomerContractStatus']=$items->getCustomerContractStatus();
           $collection[$items->get('contract_id')]['CustomerContractStatusI18n']=$items->getCustomerContractStatusI18n();
        }        
    }
    
    static function getAdminStates($collection)
    {       
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getLanguage()))    
                ->setObjects(array('CustomerContractAdminStatusI18n','CustomerContractAdminStatus'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('admin_status_id').    
                           " INNER JOIN ".CustomerContractAdminStatusI18n::getInnerForJoin('status_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                                    " AND lang='{lang}'".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery(); die(__METHOD__);
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($collection[$items->get('contract_id')]))
               continue;           
           $collection[$items->get('contract_id')]['CustomerContractAdminStatus']=$items->getCustomerContractAdminStatus();
           $collection[$items->get('contract_id')]['CustomerContractAdminStatusI18n']=$items->getCustomerContractAdminStatusI18n();
        }        
    }
    
    static function getTimeStates($collection)
    {       
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getLanguage()))    
                ->setObjects(array('CustomerContractTimeStatusI18n','CustomerContractTimeStatus'))          
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('time_state_id'). 
                           " INNER JOIN ".CustomerContractTimeStatusI18n::getInnerForJoin('status_id').                        
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                                       " AND lang='{lang}'".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($collection[$items->get('contract_id')]))
               continue;           
           $collection[$items->get('contract_id')]['CustomerContractTimeStatus']=$items->getCustomerContractTimeStatus();
           $collection[$items->get('contract_id')]['CustomerContractTimeStatusI18n']=$items->getCustomerContractTimeStatusI18n();
        }        
    }
    
    static function getOpcStates($collection)
    {       
       $db=mfSiteDatabase::getInstance();
                 $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getLanguage()))    
                ->setObjects(array('CustomerContractOpcStatusI18n','CustomerContractOpcStatus'))                
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('opc_status_id').  
                           " INNER JOIN ".CustomerContractOpcStatusI18n::getInnerForJoin('status_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                                        " AND lang='{lang}'".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($collection[$items->get('contract_id')]))
               continue;           
          $collection[$items->get('contract_id')]['CustomerContractOpcStatus']=$items->getCustomerContractOpcStatus();
           $collection[$items->get('contract_id')]['CustomerContractOpcStatusI18n']=$items->getCustomerContractOpcStatusI18n();
        }        
    }
    
    
    static function getOpcRanges($collection)
    {       
       $db=mfSiteDatabase::getInstance();
                 $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getLanguage()))    
                ->setObjects(array('CustomerContractRangeI18n','CustomerContractRange'))   
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('opc_range_id').                         
                           " INNER JOIN ".CustomerContractRangeI18n::getInnerForJoin('range_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                                " AND lang='{lang}'".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($collection[$items->get('contract_id')]))
               continue;           
           $collection[$items->get('contract_id')]['CustomerContractRange']=$items->getCustomerContractRange();
           $collection[$items->get('contract_id')]['CustomerContractRangeI18n']=$items->getCustomerContractRangeI18n();
        }        
    }
    
    static function getCallcenters($collection)
    {       
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())              
                ->setQuery("SELECT ".Callcenter::getFieldsAndKeyWithTable().",".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('callcenter_id').                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($item=$db->fetchObject('Callcenter'))
        {                   
           if (!isset($collection[$item->get('contract_id')]))
               continue;           
           $collection[$item->get('contract_id')]['Callcenter']=$item;
        }        
    }
    
    /*
     *  if ($items->hasCustomerContractProduct())
                {                       
                    if ($this->collection[$items->getCustomerContract()->get('id')]->getCustomerContract()->getContractProducts()->hasItemByKey($items->getCustomerContractProduct()->get('id')))
                       continue;                  
                  //  echo "*";
                    $items->getCustomerContractProduct()->set('product_id',$items->getProduct());
                    $this->collection[$items->getCustomerContract()->get('id')]->getCustomerContract()->getContractProducts()->push($items->getCustomerContractProduct());                                                             
                    $items->set('CustomerContractProduct',null);
                    $items->set('Product',null);
                }  
     */
    static function getProducts($collection)
    {        
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('CustomerContractProduct','Product'))
                ->setQuery("SELECT {fields} FROM ".CustomerContractProduct::getTable().                              
                           " INNER JOIN ".CustomerContractProduct::getOuterForJoin('product_id').   
                           " WHERE ".CustomerContractProduct::getTableField('contract_id')." IN('".$collection->getKeys()->implode("','")."')".
                           ";")               
                ->makeSqlQuery(); 
         // echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($collection[$items->getCustomerContractProduct()->get('contract_id')]))
               continue;  
           if ($collection[$items->getCustomerContractProduct()->get('contract_id')]->getCustomerContract()->getContractProducts()->hasItemByKey($items->getCustomerContractProduct()->get('id')))
                continue;
           $items->getCustomerContractProduct()->set('product_id',$items->getProduct());
            $collection[$items->getCustomerContractProduct()->get('contract_id')]->getCustomerContract()->getContractProducts()->push($items->getCustomerContractProduct());
        }        
    }
    
    /*
     * ",(SELECT GROUP_CONCAT(UPPER(meta_title) ORDER BY meta_title SEPARATOR ',') FROM ".Product::getTable().
                                   " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('product_id').
                                   " WHERE ".CustomerContractProduct::getTableField('contract_id')."=".CustomerContract::getTableField('id').
                                  ") as products "
     */
    
    static function getGroupedProducts($collection)
    {        
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
             //   ->setObjects(array('CustomerContractProduct'))
                ->setQuery("SELECT (SELECT GROUP_CONCAT(UPPER(meta_title) ORDER BY meta_title SEPARATOR ',') FROM ".Product::getTable().
                                   " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('product_id').
                                   " WHERE ".CustomerContractProduct::getTableField('contract_id')."=".CustomerContract::getTableField('id').                                
                                  ") as products ,".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContract::getTable().                                    
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."') ".
                                     
                           ";")               
                ->makeSqlQuery(); 
       //    echo $db->getQuery(); die(__METHOD__);
        if (!$db->getNumRows())
            return ;  
        while ($item=$db->fetchArray())
        {                   
           if (!isset($collection[$item['contract_id']]))
               continue;           
           $collection[$item['contract_id']]['products']=$item['products'];
        }        
    }
    
     static function getPartners($collection)
    {       
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('Partner'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".Partner::getTable().
                           " INNER JOIN ".CustomerContract::getInnerForJoin('financial_partner_id').                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$collection->getKeys()->implode("','")."')".
                           ";")               
                ->makeSqlQuery(); 
       //  echo $db->getQuery(); die(__METHOD__);
         
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($collection[$items->get('contract_id')]))
               continue;           
           $collection[$items->get('contract_id')]['Partner']=$items->getPartner();
        }        
    }
}

