<?php

class CustomerContractUtilsBase {
  
    
    
    static function getTeleproUsersForSelect(ConditionsQuery $where,$user,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('telepro_id').
                           ($user->hasCredential(array(array('contract_filter_equal_telepro_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")                                                        
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }     
        return $users;
    }    
    
    static function getSalesUsers1ForSelect(ConditionsQuery $where,$user,$site=null)
    {                    
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_1_id').
                           ($user->hasCredential(array(array('contract_filter_equal_sale1_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }     
        return $users;
    }      
    
    static function getSalesUsers2ForSelect(ConditionsQuery $where,$user,$site=null)
    {        
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_2_id').
                           ($user->hasCredential(array(array('contract_filter_equal_sale2_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]= mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }     
        return $users;
    }      
    
   static function getStatusForSelect($lang,ConditionsQuery $where,$site=null)
    {          
        $cache= new mfCacheFile('contract_status.conditions.select.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').
                           " LEFT JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".                            
                           $where->getWhere().
                           " GROUP BY ".CustomerContractStatusI18n::getTableField('id').
                           " ORDER BY value ASC".                            
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
           return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerContractStatusI18n'))
        {           
           // if ($item->get('id'))
                $items[$item->get('status_id')]=$item->get('value');          
          //  else
          //      $items["IS_NULL"]="---";
        }   
        $cache->register(serialize($items));
        return $items;
    }       
    
    static function getInstallStateForSelect($lang,ConditionsQuery $where,$site=null)
    {             
         $cache= new mfCacheFile('contract_install_states.conditions.select.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractInstallStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('install_state_id').
                           " LEFT JOIN ".CustomerContractInstallStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".                            
                           $where->getWhere().
                           " GROUP BY ".CustomerContractInstallStatusI18n::getTableField('id').
                           " ORDER BY value ASC".                            
                           ";")               
                ->makeSiteSqlQuery($site);         
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return array();        
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerContractInstallStatusI18n'))
        {           
           // if ($item->get('id'))
                $items[$item->get('status_id')]=$item->get('value');          
          //  else
          //      $items["IS_NULL"]="---";
        }            
        $cache->register(serialize($items));
        return $items;
    }  
         
    
    static function getTeleproUsers(ConditionsQuery $where,$user,$site=null)
    {       
        $cache= new mfCacheFile('users.telepro.conditions.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('telepro_id').($user->hasCredential(array(array('contract_filter_in_telepro_active')))?" AND ".User::getTableField('is_active')."='YES' ":"").    
                           //($user->hasCredential(array(array('contract_filter_in_telepro_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                            $where->getWhere().
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active,UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           if ($user->get('id'))
               $user->loaded();
           $users[$user->get('id')]=$user;
        }
         $cache->register(serialize($users));
        return $users;
    }
    
     static function getTeams(ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('users.teams.conditions.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('team_id').  
                           $where->getWhere().
                          " GROUP BY ".UserTeam::getTableField('id').
                          " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows()){
            $cache->register(serialize(array()));
             return array();
        }
           
        $teams=array();
        while ($team=$db->fetchObject('UserTeam'))
        {
           if ($team->get('id'))
               $team->loaded();
           $teams[$team->get('id')]=$team;
        } 
        $cache->register(serialize($teams));
        return $teams;
    }
    
     static function getTeamsForSelect(ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('users.teams.conditions.select.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  

        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('team_id').  
                           $where->getWhere().                           
                           " GROUP BY ".UserTeam::getTableField('id').
                           " ORDER BY ".UserTeam::getTableField('name')." ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $teams=array();
        while ($team=$db->fetchObject('UserTeam'))
        {          
           $teams[$team->get('id')]=mb_strtoupper($team->get('name'));
        }
        $cache->register(serialize($teams));
        return $teams;
    }
      
    
    static function getSalesUsers1(ConditionsQuery $where,$user,$site=null)
    {  
        $cache= new mfCacheFile('users.sales1.conditions.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_1_id').($user->hasCredential(array(array('contract_filter_in_sale1_active')))?" AND ".User::getTableField('is_active')."='YES' ":"").  
                       //    ($user->hasCredential(array(array('contract_filter_in_sale1_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):
                            $where->getWhere().
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active,UPPER(lastname) COLLATE utf8_general_ci ASC ".               
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           if ($user->get('id'))
               $user->loaded();           
           $users[$user->get('id')]=$user;
        }
         $cache->register(serialize($users));
        return $users;
    }   
    
    static function getSalesUsers2(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.sales2.conditions.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_2_id').($user->hasCredential(array(array('contract_filter_in_sale2_active')))?" AND ".User::getTableField('is_active')."='YES' ":"").
                           //($user->hasCredential(array(array('contract_filter_in_sale2_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           $where->getWhere().
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active,UPPER(lastname) COLLATE utf8_general_ci ASC ".           
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows()){
             $cache->register(serialize(array()));
             return array();
        }
           
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           if ($user->get('id'))
               $user->loaded();
           $users[$user->get('id')]=$user;
        }
        $cache->register(serialize($users));
        return $users;
    }   
   
    static function getStates($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('contract_status.conditions.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').
                           " LEFT JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".  
                           $where->getWhere().
                           " GROUP BY ".CustomerContractStatusI18n::getTableField('id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows()){
            $cache->register(serialize(array()));
            return array();
        }            
        $states=array();
        while ($state=$db->fetchObject('CustomerContractStatusI18n'))
        {
            if ($state->get('id'))
                $state->loaded();
            $states[$state->get('status_id')]=$state;
        }   
        $cache->register(serialize($states));
        return $states;
    }   
    
    static function getInstallStates($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('contract_install_states.conditions.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractInstallStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('install_state_id').
                           " LEFT JOIN ".CustomerContractInstallStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".  
                           $where->getWhere().                        
                           " GROUP BY ".CustomerContractInstallStatusI18n::getTableField('id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows()){
            $cache->register(serialize(array()));
            return array();
        } 
        $states=array();
        while ($state=$db->fetchObject('CustomerContractInstallStatusI18n'))
        {
           if ($state->get('id'))
               $state->loaded();
           $states[$state->get('status_id')]=$state;
        }     
        $cache->register(serialize($states));
        return $states;
    }   
 /*   
    static function getMeetings($meetings,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setObjects(array('Customer','CustomerMeeting','CustomerAddress'))
                ->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " WHERE ".CustomerAddress::getTableField('coordinates')."!='' ".
                           " ORDER BY in_at ASC".
                           ";")               
                ->makeSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $meetings=array();
        while ($items=$db->fetchObjects())
        {           
           $items->getCustomer()->set('address',$items->getCustomerAddress());
           $items->getCustomerMeeting()->set('customer_id',$items->getCustomer());           
           $dept=  substr($items->getCustomer()->getAddress()->get('postcode'),0,2);
           $date=$items->getCustomerMeeting()->getDate();        
           $meetings[$dept][$date][]=$items->getCustomerMeeting();
        }      
        ksort($meetings);
        return $meetings;
    }   */
    
    static function getTurnover($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT SUM(total_price_with_taxe) FROM ".CustomerContract::getTable().                                                                    
                           ";")               
                ->makeSiteSqlQuery($site); 
        $row=$db->fetchRow();
        return $row[0];
    }   
    
    static function getTurnoverFromPager($selection,$site=null)
    {        
        if (empty($selection))
            return null;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT SUM(total_price_with_taxe) FROM ".CustomerContract::getTable().
                           " WHERE id IN(".implode(",",$selection).")".
                           ";")               
                ->makeSiteSqlQuery($site); 
        $row=$db->fetchRow();
        return $row[0];
    }  
    
    static function getTurnoverWithoutTaxFromPager($selection,$site=null)
    {        
        if (empty($selection))
            return null;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT SUM(total_price_without_taxe) FROM ".CustomerContract::getTable().
                           " WHERE ".CustomerContract::getTableField('id')." IN(".implode(",",$selection).")".
                           ";")               
                ->makeSiteSqlQuery($site); 
        $row=$db->fetchRow();
        return $row[0];
    }  
    
    static function getTaxAmountFromPager($selection,$site=null)
    {        
        if (empty($selection))
            return null;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT SUM(total_price_without_taxe * rate ) FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('tax_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN(".implode(",",$selection).")".
                           ";")               
                ->makeSiteSqlQuery($site); 
        $row=$db->fetchRow();
        return $row[0];
    }  
    
    static function getProductsFromPager($pager)
    {       
       if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('CustomerContract','Product'))
                ->setQuery("SELECT {fields} FROM ".Product::getTable().
                           " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('product_id').     
                           " LEFT JOIN ".CustomerContractProduct::getOuterForJoin('contract_id').     
                           " WHERE ".CustomerContract::getTableField('id')." IN(".implode(",",array_keys($pager->getItems())).")".
                           " GROUP BY ".CustomerContract::getTableField('id').",".Product::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return array();        
        while ($items=$db->fetchObjects())
        {                   
            $key=$items->getCustomerContract()->get('id');       
            if (!isset($pager->items[$key]->products))
                $pager->items[$key]->products=array();
            $pager->items[$key]->products[]=$items->getProduct();
        }        
    } 
    
    static function getProductsForSelect($name,ConditionsQuery $where,$site=null)
    {   
         $cache= new mfCacheFile('products.conditions.select'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".CustomerContractProduct::getTable().
                           " LEFT JOIN ".CustomerContractProduct::getOuterForJoin('product_id').  
                           " LEFT JOIN ".CustomerContractProduct::getOuterForJoin('contract_id').  
                           $where->getWhere().
                           " GROUP BY ".Product::getTableField('id').
                           " ORDER BY ".$name." ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
            if (!$db->getNumRows())
            {
                $cache->register(serialize(array()));
               return array();
            }       
        $items=array();
        while ($item=$db->fetchObject('Product'))
        {                              
            $items[$item->get('id')]=$item->get($name);
        }     
        $cache->register(serialize($items));
        return $items;
    }  
    
    static function getProducts(ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('products.conditions.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());   
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".CustomerContractProduct::getTable().
                           " LEFT JOIN ".CustomerContractProduct::getOuterForJoin('product_id').  
                           " LEFT JOIN ".CustomerContractProduct::getOuterForJoin('contract_id'). 
                           $where->getWhere().
                           " GROUP BY ".Product::getTableField('id').
                           " ORDER BY meta_title ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return array();
        }        
        $items=array();
        while ($item=$db->fetchObject('Product'))
        {       
            $item->loaded();
            $items[$item->get('id')]=$item;
        }      
        $cache->register(serialize($items));
        return $items;
    }  
    
    static function getContracts($contracts,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setObjects(array('Customer','CustomerContract','CustomerAddress'))
                ->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " WHERE ".CustomerAddress::getTableField('coordinates')."!='' ".
                           " ORDER BY opened_at ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $contracts=array();
        while ($items=$db->fetchObjects())
        {           
           $items->getCustomer()->set('address',$items->getCustomerAddress());
           $items->getCustomerContract()->set('customer_id',$items->getCustomer());           
           $dept=  substr($items->getCustomer()->getAddress()->get('postcode'),0,2);
           $date=$items->getCustomerContract()->getOpenedAtDate();        
           $contracts[$dept][$date][]=$items->getCustomerContract();
        }      
        ksort($contracts);      
        return $contracts;
    } 
    
    static function getFinancialPartnersForSelect(ConditionsQuery $where,$user,$site=null)
    {       
         $cache= new mfCacheFile('contract_financial_partner.conditions.select.'.md5($where->getWhere().($user->hasCredential(array(array('contract_filter_equal_financial_partner_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".Partner::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('financial_partner_id').                            
                          ($user->hasCredential(array(array('contract_filter_equal_financial_partner_active')))?" WHERE ".Partner::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           " GROUP BY ".Partner::getTableField('id').
                           " ORDER BY ".Partner::getTableField('name')." ASC ".                          
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }        
        $items=array();
        while ($item=$db->fetchObject('Partner'))
        {                     
            $items[$item->get('id')]=strtoupper($item->get('name'));
        }
        $cache->register(serialize($items));
        return $items;
    }  
    
    static function getFinancialPartners(ConditionsQuery $where,$user,$site=null)
    {       
        $cache= new mfCacheFile('contract_financial_partner.conditions.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".Partner::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('financial_partner_id').($user->hasCredential(array(array('contract_filter_in_financial_partner_active')))?" AND ".Partner::getTableField('is_active')."='YES'":"").                            
                           $where->getWhere().
                           //($user->hasCredential(array(array('contract_filter_in_financial_partner_active')))?" WHERE ".Partner::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           " GROUP BY ".Partner::getTableField('id').
                           " ORDER BY ".Partner::getTableField('name')." ASC ".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }        
        $items=array();
        while ($item=$db->fetchObject('Partner'))
        {                           
            if ($item->get('id'))                
             $items[$item->get('id')]=$item->loaded();
            else
            {
             $item->id=0;
              $items[0]=$item;            
            } 
        } 
        $cache->register(serialize($items));
        return $items;
    } 
    
     
   static function getContractMinAndMaxDate(ConditionsQuery $where,$site=null)
    {       
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT min(opened_at),max(opened_at) FROM ".CustomerContract::getTable().                                                      
                           $where->getWhere().                           
                           ";")               
                ->makeSiteSqlQuery($site);        
        $row=$db->fetchRow();             
        return array($row[0],$row[1]);
    } 
    
    
     static function getContractsWithAddressFromFilter($filter,$site=null)
    {       
        $contracts=new CustomerContractPostcodeCollection(null,$site);
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setObjects(array('Customer','CustomerContract','CustomerAddress'))
                ->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " WHERE ". CustomerAddress::getTableField('coordinates')."!='' ".
                                $filter->getWhere('AND').
                           " ORDER BY opened_at ASC".
                           ";")               
                ->makeSiteSqlQuery($site);       
        if (!$db->getNumRows())
            return $contracts;        
        while ($items=$db->fetchObjects())
        {           
           $items->getCustomer()->set('address',$items->getCustomerAddress());
           $items->getCustomerContract()->set('customer_id',$items->getCustomer());                    
           $contracts->addContract($items->getCustomerContract());
        }      
        $contracts->sort();        
        return $contracts;
    } 
    
     static function getContractsFromFilter($filter,$site=null)
    {       
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setObjects(array('Customer','CustomerContract','CustomerAddress'))
                ->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " WHERE ". CustomerAddress::getTableField('coordinates')."!='' ".
                                $filter->getWhere('AND').
                           " ORDER BY opened_at ASC".
                           ";")               
                ->makeSiteSqlQuery($site);       
        if (!$db->getNumRows())
            return array();
        $contracts=array();
        while ($items=$db->fetchObjects())
        {           
           $items->getCustomer()->set('address',$items->getCustomerAddress());
           $items->getCustomerContract()->set('customer_id',$items->getCustomer());           
           $dept=$items->getCustomer()->getAddress()->getPostcodeRoot();           
           $date=$items->getCustomerContract()->getOpenedAtDate();        
           $contracts[$dept][$date][]=$items->getCustomerContract();
        }      
        ksort($contracts);
        return $contracts;
    } 
    
    
    static function getCommentsFromPager($pager)
    {              
       if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT * FROM ".CustomerContractComment::getTable().                           
                           " WHERE ".CustomerContractComment::getTableField('contract_id')." IN(".implode(",",array_keys($pager->getItems())).") AND type !='LOG'".
                           " ORDER BY created_at DESC ".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
        if (!$db->getNumRows())
            return array();        
        while ($item=$db->fetchObject('CustomerContractComment'))
        {                
            $key=$item->get('contract_id');
            $pager->items[$key]->comments[]=$item;
        }               
    } 
    
    static function getCustomerContractsByProducts($product_list,$site=null)
    {
       $db=mfSiteDatabase::getInstance();                            
       $db->setQuery("SELECT ".CustomerContract::getTableField('id')." FROM ".CustomerContractProduct::getTable(). 
                           " LEFT JOIN ".CustomerContractProduct::getOuterForJoin('contract_id').
                           " WHERE ".CustomerContractProduct::getTableField('product_id')." IN('".implode("','",$product_list)."')".
                                     " AND ".CustomerContract::getTable('status')."='ACTIVE'".
                           " GROUP BY ".CustomerContract::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();        
        $items=array();
        while ($row=$db->fetchArray())
        {                   
            $items[]=$row['id'];
        }      
        return $items; 
    }        
   
    static function getAssistantUsersForSelect(ConditionsQuery $where,$user,$site=null)
    {
         $cache= new mfCacheFile('users.assistant.conditions.select.'.md5($where->getWhere().($user->hasCredential(array(array('contract_filter_equal_assistant_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('assistant_id').                                                
                           ($user->hasCredential(array(array('contract_filter_equal_assistant_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site);        
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]= mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }         
        $cache->register(serialize($users));
        return $users;
    }
    
    static function getAssistantUsers(ConditionsQuery $where,$user,$site=null)
    {
         $cache= new mfCacheFile('users.assistant.conditions.'.md5($where->getWhere().($user->hasCredential(array(array('contract_filter_in_assistant_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('assistant_id').($user->hasCredential(array(array('contract_filter_in_assistant_active')))?" AND ".User::getTableField('is_active')."='YES'":"").    
                           //($user->hasCredential(array(array('contract_filter_in_assistant_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           $where->getWhere().
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active,UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
       // echo "<!-- ".$db->getQuery()." -->";
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           if ($user->get('id'))
               $user->loaded();
           $users[$user->get('id')]=$user;
        }
        $cache->register(serialize($users));
        return $users;           
    }
    
     static function initializeSite($site=null)
    {
         $db=mfSiteDatabase::getInstance()                    
                ->setQuery("DELETE FROM ".CustomerContract::getTable().";")               
                ->makeSiteSqlQuery($site); 
         $db->setQuery("ALTER TABLE  ".CustomerContract::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
         
         $db->setQuery("DELETE FROM ".CustomerContractProduct::getTable().";")               
                ->makeSiteSqlQuery($site);  
         $db->setQuery("ALTER TABLE  ".CustomerContractProduct::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
         
         $db->setQuery("DELETE FROM ".  CustomerContractContributor::getTable().";")               
                ->makeSiteSqlQuery($site);                 
           $db->setQuery("ALTER TABLE  ".CustomerContractContributor::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
      /*    $db->setQuery("TRUNCATE ".CustomerMeeting::getTable().";")               
                ->makeSiteSqlQuery($site); */         
         $site=$site?$site:mfContext::getInstance()->getSite()->getSite();     
         mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/frontend/data/contracts");
         mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/frontend/view/contracts");
         mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/admin/data/contracts");
         mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/admin/view/contracts");
    }
    
    
     static function getFormattedTotalAdvance($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                                          
                ->setQuery("SELECT sum(advance_payment) FROM ".CustomerContract::getTable().                                                                       
                           " WHERE status='ACTIVE';")
                ->makeSiteSqlQuery($site);   
       $row=$db->fetchRow();  
       return format_currency($row[0],'EUR');
    }
    
    static function loadContractAndCustomerFromSelection(mfArray $selection,$site=null)
    {
        $collection=new CustomerContractCollection(null,$site);
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('CustomerContract','Customer'))
                ->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().  
                           " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."')".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   trigger_error($db->getQuery());
        if (!$db->getNumRows())
            return $collection;
        while ($items=$db->fetchObjects())
        {
            $item=$items->getCustomerContract();
            $item->set('customer_id',$items->getCustomer());
            $collection[$item->get('id')]=$item;
        }        
        return $collection;
    }     
    
     static function sendSmsModelMultipleContracts($selection, $model_i18n,$site=null)
    {
          $sms=new SmsBoxApi(array('callback'=>1));                    
          $collection_sms_sent=new CustomerSmsSentCollection(null,$site);                
          $action=mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();           
          foreach (self::loadContractAndCustomerFromSelection($selection,$site) as $contract)
          {   
              
                if (!$contract->getCustomer()->hasMobile())
                        continue;
                try
                {                  
                  $message=$action->getComponent('/customers_contracts/sms', array('COMMENT'=>false,'contract'=>$contract,'model_i18n'=>$model_i18n))->getContent();         
                }
                catch (SmartyCompilerException $e)
                {
                    trigger_error($e->getMessage());
                    throw new mfException(__("Error Syntax in model."));              
                }               
             //   echo "Message=".$message." Phone=".$contract->getCustomer()->get('mobile')."<br/>";
              //  echo "<pre>"; var_dump($meeting); echo "</pre>"; 
               $sms_box=new SmsBoxApi(array('callback'=>1));                             
               $sms_box->send($contract->getCustomer()->get('mobile'),$message); // add model 
               // SMS Sent 
              $sms=new CustomerSmsSent(null,$site);
               $sms->add(array('mobile'=>$contract->getCustomer()->get('mobile'),
                               'model_id'=>$model_i18n->get('model_id'),
                               'message'=>$message,
                               'customer_id'=>$contract->get('customer_id')));
               $collection_sms_sent[]=$sms;              
          }
          $collection_sms_sent->save();
          
          // SMS History
          $collection_sms_history=new CustomerSmsHistoryCollection(null,$site);  
          foreach ( $collection_sms_sent as $sms)
          {
               $history=new CustomerSmsHistory(null,$site); 
               $history->setUser($action->getUser()->getGuardUser());
               $history->setSms($sms);
               $collection_sms_history[]=$history;
          }    
          $collection_sms_history->save();
    }   
    
    static function getMeetingsFromContracts($contract_list,$site=null)
    {
       $list=new mfArray();
       $db=mfSiteDatabase::getInstance();
       $db->setParameters(array())                
                ->setQuery("SELECT ".CustomerMeeting::getTableField('id')." FROM ".CustomerMeeting::getTable(). 
                           " INNER JOIN ".CustomerContract::getInnerForJoin('meeting_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$contract_list->implode("','")."')".                                     
                           ";")               
                ->makeSiteSqlQuery($site);  
      // echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;
        while ($row=$db->fetchArray())
        {
            $list[]=$row['id'];
        }
        return $list;
    }
    
     static function createDefaultProductsForMultipleContracts($selection,$site=null)
    {        
         // Create Products for meetings
         CustomerMeetingUtils::createDefaultProductsForMultipleMeetings(self::getMeetingsFromContracts($selection,$site),$site);  
         // Create Products for contracts
      // return ;           
        $products_by_default=ProductSettings::load($site)->getDefaultProductsById();
        // Manage contracts without products
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT ".CustomerContract::getTableField('id')." FROM ".CustomerContract::getTable(). 
                           " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."')".  
                                    " AND ".CustomerContractProduct::getTableField('id')." IS NULL".
                                    " AND is_hold='NO'".
                           ";")               
                ->makeSiteSqlQuery($site); 
       //      echo $db->getQuery();
        if ($db->getNumRows())
        {
            $collection=new CustomerContractProductCollection(null,$site);
            while ($row=$db->fetchArray())
            {                                                   
                foreach ($products_by_default as $product_id)
                {
                    $item=new CustomerContractProduct(null,$site);
                    $item->add(array('product_id'=>$product_id,'contract_id'=>$row['id']));
                    $collection[]=$item;
                }    
            } 
            $collection->save();
        }
        // add non existing products
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT ".CustomerContract::getTableField('id').",".
                                 " GROUP_CONCAT(". CustomerContractProduct::getTableField('product_id')." SEPARATOR '|') as products".
                           " FROM ".CustomerContract::getTable(). 
                           " INNER JOIN ".CustomerContractProduct::getInnerForJoin('contract_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."')".   
                           " GROUP BY ".CustomerContract::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($site); 
         //   echo $db->getQuery();
        if (!$db->getNumRows())
            return ;   
        $collection=new CustomerContractProductCollection(null,$site);        
        while ($row=$db->fetchArray())
        {     
            $products= explode("|", $row['products']);                
            foreach ($products_by_default as $product_id)
            {
               if (in_array($product_id,$products))
                   continue;               
                $item=new CustomerContractProduct(null,$site);
                $item->add(array('product_id'=>$product_id,'contract_id'=>$row['id']));
                $collection[]=$item;
            }   
        } 
        $collection->save(); 
    }    
    
    
    static function updateReferenceForMultipleContracts($reference,$selection,$site=null)
    {
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('reference'=>$reference))                
                ->setQuery("UPDATE ".CustomerContract::getTable()." SET reference='{reference}'".                          
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."')". 
                                " AND is_hold='NO'".
                           ";")               
                ->makeSiteSqlQuery($site); 
    }        
    
    
    static function getPollutersForSelect(ConditionsQuery $where,$user,$site=null)
    {       
        $cache= new mfCacheFile('polluters.contract.conditions.select.'.md5($where->getWhere().($user->hasCredential(array(array('superadmin','contract_filter_equal_polluter_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".PartnerPolluterCompany::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('polluter_id').                                                      
                           " WHERE ".PartnerPolluterCompany::getTableField('id')." IS NOT NULL ".
                                    ($user->hasCredential(array(array('superadmin','contract_filter_equal_polluter_active')))?" AND ".PartnerPolluterCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".PartnerPolluterCompany::getTableField('id').
                           " ORDER BY ".PartnerPolluterCompany::getTableField('name')." ASC ".                          
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }       
        $items=array();
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {                              
            $items[$item->get('id')]=strtoupper($item->get('name'));
        }  
        $cache->register(serialize($items));
        return $items;
    }  
    
    static function getPolluters(ConditionsQuery $where,$user,$site=null)
    {       
        $cache= new mfCacheFile('polluters.conditions.contract.'.md5($where->getWhere().($user->hasCredential(array(array('superadmin','contract_filter_in_polluter_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".PartnerPolluterCompany::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('polluter_id').($user->hasCredential(array(array('superadmin','contract_filter_in_polluter_active')))?" AND ".PartnerPolluterCompany::getTableField('is_active')."='YES' ":"").                            
                           " WHERE ".PartnerPolluterCompany::getTableField('id')." IS NOT NULL ".
                                    //($user->hasCredential(array(array('superadmin','contract_filter_in_polluter_active')))?" AND ".PartnerPolluterCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".PartnerPolluterCompany::getTableField('id').
                           " ORDER BY is_active,".PartnerPolluterCompany::getTableField('name')." ASC ".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }       
        $item=new PartnerPolluterCompany(null,$site);
        $item->id=0;
        $items=array($item);
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {                                              
             $items[$item->get('id')]=$item->loaded();           
        }
        $cache->register(serialize($items));
        return $items;
    } 
 
    /*
      UPDATE t_customers_contract
      INNER JOIN t_users_team_users ON t_users_team_users.user_id=t_customers_contract.telepro_id
      SET t_customers_contract.team_id=t_users_team_users.team_id
      WHERE t_customers_contract.telepro_id!=''
     */
  
    static function updateTeamsFromTelepro($selection,$site=null)
    {
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("UPDATE ".CustomerContract::getTable().
                           " INNER JOIN ".UserTeamUsers::getTable(). " ON ".UserTeamUsers::getTableField('user_id')."=".CustomerContract::getTableField('telepro_id').
                           " SET ".CustomerContract::getTableField('team_id')."=".UserTeamUsers::getTableField('team_id').                        
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."') AND ".                                     
                                CustomerContract::getTableField('telepro_id')."!=''".
                                " AND is_hold='NO'".
                           ";")               
                ->makeSiteSqlQuery($site); 
        mfCacheFile::removeCache('users.teams','admin',$site);      
    }        
    
     
    static function getTimeStateForSelect($lang,ConditionsQuery $where,$site=null)
    { 
        $cache= new mfCacheFile('contract_time_status.select.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractTimeStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('time_state_id').
                           " LEFT JOIN ".CustomerContractTimeStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".                            
                           $where->getWhere().
                           " GROUP BY ".CustomerContractTimeStatusI18n::getTableField('id').
                           " ORDER BY value ASC".                            
                           ";")               
                ->makeSiteSqlQuery($site);         
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerContractTimeStatusI18n'))
        {                    
                $items[$item->get('status_id')]=$item->get('value');                   
        }       
         $cache->register(serialize($items));
        return $items;
    }       
       
    
    static function getTimeStates($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('contract_time_status.conditions.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());    
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractTimeStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('time_state_id').
                           " LEFT JOIN ".CustomerContractTimeStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".  
                           $where->getWhere().                        
                           " GROUP BY ".CustomerContractTimeStatusI18n::getTableField('id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
       if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $states=array();
        while ($state=$db->fetchObject('CustomerContractTimeStatusI18n'))
        {                       
            if ($state->get('id'))                            
                $states[$state->get('status_id')]=  $state->loaded();
           else
            $states['NULL']= $state;          
        } 
        $cache->register(serialize($states));
        return $states;
    }              
    
    static function generateCoordinatesFromContractFilter(CustomerContractsFormFilter $filter,$forced=false,$site=null)
    {      
       $messages=new mfArray();      
       if ($forced)
           $query=$filter->getQuery();
       else    
           $query = str_replace("WHERE"," WHERE ".CustomerAddress::getTableField('coordinates')."='' AND ",$filter->getQuery());
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())               
                ->setObjects(array('CustomerAddress')) 
                ->setQuery($query)               
                ->makeSiteSqlQuery($site);         
         if (!$db->getNumRows())
            return $messages->push(__("No coordinate has been generated."));   
        $addresses=new CustomerAddressCollection(null,$site);
        while ($items=$db->fetchObjects())
        {                           
            $addresses[]=$items->getCustomerAddress();
        }     
        $addresses->loaded();
        $addresses->generateCoordinates(true);        
        $messages->push(__("%d coordinates have an error.",$addresses->getNumberOfErrors()));
        $messages->push(__("%d coordinates have been processed.",$addresses->getNumberOfValidAddress())); 
        return $messages;
    }
            
    static function sendEmailContractToTeamManager(CustomerContract $contract,$model)
    {      
       $messages=mfMessages::getInstance();
       if (!$contract->hasTelepro())
       {
           $messages->addWarning(__("No telepro on contract, no email sent for state change."));
           return ;       
       }    
       if (!$contract->getTelepro()->hasTeamManagers())
       {
          $messages->addWarning(__("Telepro has no manager to sent email for state change.")); 
          return ;              
       }   
       if ($contract->getTelepro()->getTeamManagers()->getEmails()->isEmpty())
       {
           $messages->addWarning(__("Managers [%s] has no email to sent state change.",$contract->getTelepro()->getTeamManagers()->implode()));
           return ;
       }           
       $action=mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();                    
       $emailer=$action->getMailer();
    //   $emailer->debug();  
       // User email sent
       $emails_sent=new UserEmailSentCollection(null,$contract->getSite());
       foreach ($contract->getTelepro()->getTeamManagers()->getUsersWithEmail() as $user)
       {
            $email_sent=new  UserEmailSent(null,$contract->getSite());
            $email_sent->add(array('user_id'=>$user,'email'=>$user->get('email'),'model_id'=>$model,'customer_id'=>$contract->getCustomer()));
            $emails_sent[]=$email_sent;
       }       
       try
        {               
          $company=SiteCompanyUtils::getSiteCompany();             
          $emailer->sendMail('users_communication_emails','emailForContract', array($company->get('email') => $company->get('name')), 
                                                                  $contract->getTelepro()->getTeamManagers()->getEmails()->toArray(),
                                                            $model->getI18n()->get('subject'),
                                                            array(
                                                                  'contract'=>$contract,
                                                                  'model_i18n'=>$model->getI18n())) ;
           
        }
        catch (Swift_TransportException $e) 
        {
                $messages->addError($e);
        } 
        catch (Swift_MimeException $e) 
        {
                $messages->addError($e);
        } 
        catch (Exception $e) 
        {
                $messages->addError($e);
        }
        foreach ($emails_sent as $email)
        {
            $email->isSent();
            $email->set('body',$emailer->getContent());            
        }    
        $emails_sent->save();
        $history_collection=new UserEmailHistoryCollection(null,$contract->getSite());
        foreach ($emails_sent as $email)
        {    
                $history=new UserEmailHistory(null,$contract->getSite());
                $history->setUser(mfcontext::getInstance()->getUser()->getGuardUser());
                $history->setEmail($email);
        }        
        $history_collection->save();   
        $messages->addInfo(__("Email has been sent to managers [%s] for state change.",$contract->getTelepro()->getTeamManagers()->implode()));
    }
    
      static function getOpcRangeForSelect($lang,ConditionsQuery $where,$site=null)
    {  
        $cache= new mfCacheFile('range.opc.contract.conditions.select.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractRangeI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('opc_range_id').
                           " LEFT JOIN ".CustomerContractRangeI18n::getInnerForJoin('range_id')." AND lang='{lang}'".                            
                           $where->getWhere().
                           " GROUP BY ".CustomerContractRangeI18n::getTableField('id').
                           " ORDER BY ".CustomerContractRange::getTableField('from')." ASC".                            
                           ";")               
                ->makeSiteSqlQuery($site);         
        if (!$db->getNumRows())
         {
             $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerContractRangeI18n'))
        {                    
                $items[$item->get('range_id')]=mb_strtoupper($item->get('value'));                   
        }               
        $cache->register(serialize($items));
        return $items;
    }    
       
    
    static function getOpcRanges($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('range.opc.contract.conditions.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractRangeI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('opc_range_id').
                           " LEFT JOIN ".CustomerContractRangeI18n::getInnerForJoin('range_id')." AND lang='{lang}'".  
                           $where->getWhere().                        
                           " GROUP BY ".CustomerContractRangeI18n::getTableField('id').
                           " ORDER BY ".CustomerContractRange::getTableField('from')." ASC".            
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $states=array();
        while ($state=$db->fetchObject('CustomerContractRangeI18n'))
        {
           if ($state->get('id'))
               $state->loaded();
           $states[$state->get('range_id')]=$state;
        }     
        $cache->register(serialize($states));
        return $states;
    }   
    
    
     static function updateRange($selection,$site=null)
    {
         foreach (CustomerContractRange::getRanges() as $range)
       {
           $db=mfSiteDatabase::getInstance()
                ->setParameters(array('from'=>$range->get('from'),'to'=>$range->get('to'),'range_id'=>$range->get('id')))               
                ->setQuery("UPDATE ".CustomerContract::getTable().                                                     
                           " SET opc_range_id='{range_id}'".
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."') ".                                                           
                                " AND TIME(opc_at) >= '{from}' AND TIME(opc_at) < '{to}' ".
                                " AND is_hold='NO'".
                           ";")               
                ->makeSiteSqlQuery($site);  
        //   echo $db->getQuery()."<br>";
       }    
    }    
    
    
    static function getOpcStatusForSelect($lang,ConditionsQuery $where,$site=null)
    { 
        $cache= new mfCacheFile('contract_opc_status.conditions.select.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractOpcStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('opc_status_id').
                           " LEFT JOIN ".CustomerContractOpcStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".                            
                           $where->getWhere().
                           " GROUP BY ".CustomerContractOpcStatusI18n::getTableField('id').
                           " ORDER BY value ASC".                            
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerContractOpcStatusI18n'))
        {           
           // if ($item->get('id'))
                $items[$item->get('status_id')]=$item->get('value');          
          //  else
          //      $items["IS_NULL"]="---";
        }     
        $cache->register(serialize($items));
        return $items;
    }    
    
    static function getOpcStatuses($lang,ConditionsQuery $where,$site=null)
    {
         $cache= new mfCacheFile('contract_opc_status.conditions.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractOpcStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('opc_status_id').
                           " LEFT JOIN ".CustomerContractOpcStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".  
                           $where->getWhere().
                           " GROUP BY ".CustomerContractOpcStatusI18n::getTableField('id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $states=array();
        while ($state=$db->fetchObject('CustomerContractOpcStatusI18n'))
        {
           if ($state->get('id'))                            
                $states[$state->get('status_id')]=  $state->loaded();
           else
                $states['NULL']= $state;                       
        }  
        $cache->register(serialize($states));
        return $states;
    }   
    
  static function loadContractWithCustomerAndPartnerFromSelection($selection,$site=null)
    {
        $collection=new CustomerContractCollection(null,$site);
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('CustomerContract','Customer','Partner'))
                ->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().  
                           " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('financial_partner_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."')".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   trigger_error($db->getQuery());
        if (!$db->getNumRows())
            return $collection;
        while ($items=$db->fetchObjects())
        {
            $item=$items->getCustomerContract();
            $item->set('customer_id',$items->getCustomer());
            $item->set('financial_partner_id',$items->hasPartner()?$items->getPartner():0);
            $collection[$item->get('id')]=$item;
        }        
        return $collection;
    }   
    
     static function loadContractWithCustomerFromSelection($selection,$site=null)
    {
        $collection=new CustomerContractCollection(null,$site);
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('CustomerContract','Customer'))
                ->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().  
                           " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').                        
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."')".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   trigger_error($db->getQuery());
        if (!$db->getNumRows())
            return $collection;
        while ($items=$db->fetchObjects())
        {
            $item=$items->getCustomerContract();
            $item->set('customer_id',$items->getCustomer());          
            $collection[$item->get('id')]=$item;
        }        
        return $collection;
    }   
    
    
    
    static function getAdminStatusForSelect($lang,ConditionsQuery $where,$site=null)
    {    
        $cache= new mfCacheFile('contract_admin_status.conditions.select.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractAdminStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('admin_status_id').
                           " LEFT JOIN ".CustomerContractAdminStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".                            
                           $where->getWhere().
                           " GROUP BY ".CustomerContractAdminStatusI18n::getTableField('id').
                           " ORDER BY value ASC".                            
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerContractAdminStatusI18n'))
        {           
           // if ($item->get('id'))
                $items[$item->get('status_id')]=$item->get('value');          
          //  else
          //      $items["IS_NULL"]="---";
        }    
        $cache->register(serialize($items));
        return $items;
    }   
    
    
     static function getAdminStatuses($lang,ConditionsQuery $where,$site=null)
    {
         $cache= new mfCacheFile('contract_admin_status.conditions.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractAdminStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('admin_status_id').
                           " LEFT JOIN ".CustomerContractAdminStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".  
                           $where->getWhere().
                           " GROUP BY ".CustomerContractAdminStatusI18n::getTableField('id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $states=array();
        while ($state=$db->fetchObject('CustomerContractAdminStatusI18n'))
        {
           if ($state->get('id'))                            
                $states[$state->get('status_id')]=  $state->loaded();
           else
            $states['NULL']= $state;                       
        }       
        $cache->register(serialize($states));
        return $states;
    }  
    
    
    static function getLayersForSelect(ConditionsQuery $where,$user,$site=null)
    { 
        $cache= new mfCacheFile('layers.select.conditions.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".PartnerLayerCompany::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('partner_layer_id').                            
                           " WHERE ".PartnerLayerCompany::getTableField('id')." IS NOT NULL ".
                                    ($user->hasCredential(array(array('contract_filter_equal_layer_active')))?" AND ".PartnerLayerCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".PartnerLayerCompany::getTableField('id').
                           " ORDER BY ".PartnerLayerCompany::getTableField('name')." ASC ".                          
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }       
        $items=array();
        while ($item=$db->fetchObject('PartnerLayerCompany'))
        {                              
            $items[$item->get('id')]=strtoupper($item->get('name'));
        }
        $cache->register(serialize($items));
        return $items;
    }   
    
    static function getLayers(ConditionsQuery $where,$user,$site=null)
    {               
        $cache= new mfCacheFile('layers.conditions.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".PartnerLayerCompany::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('partner_layer_id').($user->hasCredential(array(array('contract_filter_in_layer_active')))?" AND ".PartnerLayerCompany::getTableField('is_active')."='YES' ":"").                            
                           " WHERE ".PartnerLayerCompany::getTableField('id')." IS NOT NULL ".
                                    //($user->hasCredential(array(array('contract_filter_in_layer_active')))?" AND ".PartnerLayerCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".PartnerLayerCompany::getTableField('id').
                           " ORDER BY ".PartnerLayerCompany::getTableField('name')." ASC ".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }           
        $item=new PartnerLayerCompany(null,$site);
        $item->id=0;
        $items=array($item);
        while ($item=$db->fetchObject('PartnerLayerCompany'))
        {                                              
             $items[$item->get('id')]=$item->loaded();          
        }        
        $cache->register(serialize($items));
        return $items;
    } 
    
    static function getContractsFromSelection(mfArray $selection,$site=null)
    {        
        $collection=new CustomerContractCollection(null,$site);
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT * FROM ".CustomerContract::getTable().                                                                  
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."')".                               
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $collection;                  
        while ($item=$db->fetchObject('CustomerContract'))
        {                            
            $collection[$item->get('id')]=$item->loaded()->setSite($site);
        }  
        return $collection;
    }     
    
    static function getContractsUnHoldFromSelection(mfArray $selection,$site=null)
    {        
        $collection=new CustomerContractCollection(null,$site);
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT * FROM ".CustomerContract::getTable().                                                                  
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."')".
                                " AND is_hold='NO'".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $collection;                  
        while ($item=$db->fetchObject('CustomerContract'))
        {                            
            $collection[$item->get('id')]=$item->loaded()->setSite($site);
        }  
        return $collection;
    }     
    
    static function updateSale2ForMeetings(CustomerContractMultipleProcess $multiple)
    {      
       $db=mfSiteDatabase::getInstance()
                ->setParameters(array('sale2_id'=>$multiple->getParameter('meeting_sale2_id')))
                ->setQuery("UPDATE ".CustomerMeeting::getTable(). 
                           " INNER JOIN ".CustomerContract::getInnerForJoin('meeting_id').
                           " SET ".CustomerMeeting::getTableField('sale2_id')."='{sale2_id}'". 
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$multiple->getSelection()->implode("','")."')". 
                                " AND ".CustomerContract::getTableField('is_hold')."='NO'".
                           ";")               
                ->makeSiteSqlQuery($multiple->getSite()); 
       //echo $db->getQuery();
    }        
    
    static function getCreatedByUsers(ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('users.created_by.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('created_by_id').    
                           $where->getWhere().
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           if ($user->get('id'))
               $user->loaded();
           $users[$user->get('id')]=$user;
        }
        $cache->register(serialize($users));
        return $users;
    }
    
     static function getCreatedByUsersForSelect(ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('contract.created_by.conditions.select.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('created_by_id').                                                
                           $where->getWhere().  
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site);        
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }
        $cache->register(serialize($users));
        return $users;
    }
    
    
    static function sendEmailToSale1(CustomerContract $contract)
    {
        if (!mfModule::isModuleInstalled('emailer_spooler',$contract->getSite()))
            return mfMessages::getInstance()->addWarning(__("Emailer spooler module is not present."));
        $settings=new CustomerContractSettings(null,$contract->getSite());
        if (!$settings->hasChangeStateSalesModelEmail())        
            return mfMessages::getInstance()->addWarning(__('Model for sale email is invalid.'));
        if (!$contract->getSale1()->hasEmail())               
            return mfMessages::getInstance()->addWarning(__("Sale %s has not email.",(string)$contract->getSale1()->getFormatter()->getUser()->upper()));
                  
        $action=mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
        $model_i18n=$settings->getChangeStateSalesModelEmail()->getI18n();
        $email_company=SiteCompanyUtils::getSiteCompany($contract->getSite())->get('email');
        try
        {                  
          $message=$action->getComponent('/customers_contracts/emailChangesForSale', array('COMMENT'=>false,
                        'contract'=>$contract,
                        'user'=>$contract->getSale1(),
                        'model_i18n'=>$model_i18n))->getContent(); 
          //var_dump($message);
               $sms=new UserEmailSent(null,$contract->getSite());
               $sms->add(array('email'=>$contract->getSale1()->get('email'),
                               'model_id'=>$model_i18n->get('model_id'),
                               'body'=>$message,
                               'subject'=>$model_i18n->get('subject'),
                               'user_id'=>$contract->getSale1()));
               $sms->save();
               // Spooler
               $email=new EmailerSpooler();
               $email->add(array('to'=>$contract->getSale1()->get('email'),
                               'model_id'=>$model_i18n->get('model_id'),
                               'site_id'=> $model_i18n->getSite(),
                               'from'=>$email_company,
                               'body'=>$message,
                               'subject'=>$model_i18n->get('subject'),
                               'customer_id'=>$contract->get('customer_id')));
               $email->save();
               // History
               $history=new UserEmailHistory(null,$contract->getSite()); 
               $history->setUser($action->getUser()->getGuardUser());
               $history->setEmail($email);
               $history->save();
               mfMessages::getInstance()->addInfo(__("Email has been sent to sale."));
        }
        catch (SmartyCompilerException $e)
        {
            trigger_error($e->getMessage());
            return mfMessages::getInstance()->addError(__("Error Syntax in model."));              
        }   
    }
    
    
    static function generateCoordinates(mfArray $selection,$site=null)
    {      
         $messages=new mfArray();
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())               
                ->setQuery("SELECT ".CustomerAddress::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().                             
                           " INNER JOIN ".CustomerAddress::getTable()." ON ".CustomerAddress::getTableField('customer_id')."=".CustomerContract::getTableField('customer_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."') AND ".                           
                                CustomerAddress::getTableField('coordinates')."=''".
                           ";")               
                ->makeSiteSqlQuery($site); 
        // echo $db->getQuery();
         if (!$db->getNumRows())
            return $messages->push(__("No coordinate has been generated."));     
        $addresses=new CustomerAddressCollection(null,$site);
        while ($item=$db->fetchObject('CustomerAddress'))
        {                           
            $addresses[]=$item->loaded()->setSite($site);            
        }     
        $addresses->loaded();
        $addresses->generateCoordinates(true);        
        $messages->push(__("%d coordinates have an error.",$addresses->getNumberOfErrors()));
        $messages->push(__("%d coordinates have been processed.",$addresses->getNumberOfValidAddress())); 
      //  SystemDebug::getInstance()->trace(date("Y-m-d H:i:s").":Contrat:Multiple [".(string)mfCOntext::getInstance()->getUser()->getGuardUser()."] ".$addresses->getNumberOfValidAddress());
        return $messages;
    }
    
    
    static function removeContractsFromMeetings(CustomerMetingCollection $collection)
    {        
        // Supprime customers sans contracts
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())               
                ->setQuery("DELETE ".Customer::getTable()." FROM ".Customer::getTable().
                           " INNER JOIN ".CustomerMeeting::getInnerForJoin('customer_id').         
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('meeting_id').                                                      
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$collection->getArrayKeys()->implode("','")."') AND ".                                                          
                                    CustomerContract::getTableField('id')." IS NULL ".
                           ";")               
                ->makeSiteSqlQuery($collection->getSite());
       //echo $db->getQuery(); 
       $db=mfSiteDatabase::getInstance()
                ->setParameters(array())               
                ->setQuery("UPDATE ".CustomerContract::getTable().                                                       
                           " SET meeting_id=NULL".
                           " WHERE ".CustomerContract::getTableField('meeting_id')." IN('".$collection->getArrayKeys()->implode("','")."')".                                                          
                           ";")               
                ->makeSiteSqlQuery($collection->getSite());
    }
    
    static function getNumberOfTeamAttributions($site=null)
    {
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())               
                ->setQuery("SELECT count(".CustomerContract::getTableField('id'). ") FROM ".CustomerContract::getTable(). 
                           " LEFT JOIN ".CustomerContractContributor::getInnerForJoin('contract_id')." AND ".CustomerContractContributor::getTableField('type')."='team'".
                           " WHERE ".CustomerContractContributor::getTableField('id')." IS NULL". 
                           ";")               
                ->makeSiteSqlQuery($site);  
       $row=$db->fetchRow();
       return $row[0];
    }        
    
    static function getNumberOfAttributedContracts($site=null)
    {
       $db=mfSiteDatabase::getInstance()
                ->setParameters(array())               
                ->setQuery("SELECT count(".CustomerContract::getTableField('id'). ") FROM ".CustomerContract::getTable().                             
                           ";")               
                ->makeSiteSqlQuery($site);  
       $row=$db->fetchRow();
       return $row[0];
    }
    
    static function updateTeamAttributionsForContracts($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('limit'=>CustomerContractSettings::load($site)->get('number_of_attributions',500)))
                ->setQuery("SELECT ".CustomerContract::getTableFields(array('id','team_id'))." FROM ".CustomerContract::getTable(). 
                           " LEFT JOIN ".CustomerContractContributor::getInnerForJoin('contract_id')." AND ".CustomerContractContributor::getTableField('type')."='team'".
                           " WHERE ".CustomerContractContributor::getTableField('id')." IS NULL". 
                           " LIMIT 0,{limit}".
                           ";")               
                ->makeSiteSqlQuery($site);  
        if (!$db->getNumRows())
            return ;
        $collection = new CustomerContractContributorCollection(null,$site);
        $settings=new CustomerContractSettings(null,$site);
        while ($row=$db->fetchArray())
        {
             $item=new CustomerContractContributor(null,$site);
             $item->add(array('team_id'=>$row['team_id']?$row['team_id']:null,
                              'contract_id'=>$row['id'],
                              'attribution_id'=>$settings->get('default_attribution_id'),
                              'type'=>'team'));
             $collection[]=$item;
        }         
        $collection->save();
    }    



     static function getSavAtRangeForSelect($lang,ConditionsQuery $where,$site=null)
    {   
        $cache= new mfCacheFile('range.sav_at.contract.conditions.select.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractRangeI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sav_at_range_id').
                           " LEFT JOIN ".CustomerContractRangeI18n::getInnerForJoin('range_id')." AND lang='{lang}'".                            
                           $where->getWhere().
                           " GROUP BY ".CustomerContractRangeI18n::getTableField('id').
                           " ORDER BY ".CustomerContractRange::getTableField('from')." ASC".                            
                           ";")               
                ->makeSiteSqlQuery($site);         
        if (!$db->getNumRows())
         {
             $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerContractRangeI18n'))
        {                    
                $items[$item->get('range_id')]=mb_strtoupper($item->get('value'));                   
        }
         $cache->register(serialize($items));
        return $items;
    }   
       
    
    static function getSavAtRanges($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('range.sav_at.contract.conditions.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractRangeI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sav_at_range_id').
                           " LEFT JOIN ".CustomerContractRangeI18n::getInnerForJoin('range_id')." AND lang='{lang}'".  
                           $where->getWhere().                        
                           " GROUP BY ".CustomerContractRangeI18n::getTableField('id').
                           " ORDER BY ".CustomerContractRange::getTableField('from')." ASC".            
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $states=array();
        while ($state=$db->fetchObject('CustomerContractRangeI18n'))
        {
           if ($state->get('id'))
               $state->loaded();
           $states[$state->get('range_id')]=$state;
        }    
        $cache->register(serialize($states));
        return $states;
    }       
    
    static function getNumberOfDatesNotValid($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT count(id) FROM ".CustomerContract::getTable().
                           " WHERE dates_is_valid='NO' AND status='ACTIVE'".                                       
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return 0;
        $row=$db->fetchRow();
        return intval($row[0]);
    }
    
    
    static function updateDatesIsValid($site=null)
    {
        //  'quoted_at','billing_at',
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("UPDATE ".CustomerContract::getTable().
                           " SET dates_is_valid ='YES'".
                           " WHERE  pre_meeting_at >= sav_at AND pre_meeting_at IS NOT NULL ".
                            " AND quoted_at >= pre_meeting_at AND quoted_at IS NOT NULL ".
                            " AND opened_at >= quoted_at AND opened_at IS NOT NULL ".
                            " AND billing_at >= opened_at AND billing_at IS NOT NULL ".
                            " AND doc_at >= billing_at AND doc_at IS NOT NULL ".
                            " AND opc_at >= doc_at AND opc_at IS NOT NULL ".
                            " AND status='ACTIVE'".
                           ";")               
                ->makeSiteSqlQuery($site);         
      //  echo $db->getQuery();
    }        
    
    
    
      static function loadContractAndPartnerFromSelection(mfArray $selection,$site=null)
    {
        $collection=new CustomerContractCollection(null,$site);
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('CustomerContract','Partner'))
                ->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().  
                           " INNER JOIN ".CustomerContract::getOuterForJoin('financial_partner_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$selection->implode("','")."')".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   trigger_error($db->getQuery());
        if (!$db->getNumRows())
            return $collection;
        while ($items=$db->fetchObjects())
        {
            $item=$items->getCustomerContract();
            $item->set('financial_partner_id',$items->getPartner());
            $collection[$item->get('id')]=$item;
        }        
        return $collection;
    }     
        
    static function getNumberOfActiveIsDocument(CustomerContractsPager $pager)
    {        
        $db=mfSiteDatabase::getInstance()
                ->setParameters($pager->getParameters())
                ->setQuery(str_replace("WHERE","WHERE ".CustomerContract::getTableField('is_document')."='Y' AND ",str_replace("{fields}","count(tmp.id) FROM (SELECT ".CustomerContract::getTableField('id')." as id",$pager->getQuery())).") as tmp")               
                ->makeSqlQuery();          
         $row=$db->fetchRow();
         return intval($row[0]); 
    }
    
    static function getNumberOfNoActiveIsDocument(CustomerContractsPager $pager)
    {
           $db=mfSiteDatabase::getInstance()
                ->setParameters($pager->getParameters())
                ->setQuery(str_replace("WHERE","WHERE ".CustomerContract::getTableField('is_document')."='N' AND ",str_replace("{fields}","count(tmp.id) FROM (SELECT ".CustomerContract::getTableField('id')." as id",$pager->getQuery())).") as tmp")               
                ->makeSqlQuery();          
         $row=$db->fetchRow();
         return intval($row[0]);         
    }
    
    static function getNumberOfActiveIsPhoto(CustomerContractsPager $pager)
    {        
        $db=mfSiteDatabase::getInstance()
                ->setParameters($pager->getParameters())
                ->setQuery(str_replace("WHERE","WHERE ".CustomerContract::getTableField('is_photo')."='Y' AND ",str_replace("{fields}","count(tmp.id) FROM (SELECT ".CustomerContract::getTableField('id')." as id",$pager->getQuery())).") as tmp")               
                ->makeSqlQuery();          
         $row=$db->fetchRow();
         return intval($row[0]); 
    }
    
    static function getNumberOfNoActiveIsPhoto(CustomerContractsPager $pager)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters($pager->getParameters())
                ->setQuery(str_replace("WHERE","WHERE ".CustomerContract::getTableField('is_photo')."='N' AND ",str_replace("{fields}","count(tmp.id) FROM (SELECT ".CustomerContract::getTableField('id')." as id",$pager->getQuery())).") as tmp")               
                ->makeSqlQuery();          
         $row=$db->fetchRow();
         return intval($row[0]);         
    }
    
    static function getNumberOfActiveIsQuality(CustomerContractsPager $pager)
    {        
        $db=mfSiteDatabase::getInstance()
                ->setParameters($pager->getParameters())
                ->setQuery(str_replace("WHERE","WHERE ".CustomerContract::getTableField('is_quality')."='Y' AND ",str_replace("{fields}","count(tmp.id) FROM (SELECT ".CustomerContract::getTableField('id')." as id",$pager->getQuery())).") as tmp")               
                ->makeSqlQuery();          
         $row=$db->fetchRow();
         return intval($row[0]); 
    }
    
    static function getNumberOfNoActiveIsQuality(CustomerContractsPager $pager)
    {
           $db=mfSiteDatabase::getInstance()
                ->setParameters($pager->getParameters())
                ->setQuery(str_replace("WHERE","WHERE ".CustomerContract::getTableField('is_quality')."='N' AND ",str_replace("{fields}","count(tmp.id) FROM (SELECT ".CustomerContract::getTableField('id')." as id",$pager->getQuery())).") as tmp")               
                ->makeSqlQuery();          
         $row=$db->fetchRow();
         return intval($row[0]);         
    }
    
    
     static function getStatusesForSelect($site=null)
    {        
        $cache= new mfCacheFile('contract_status.conditions.select','admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
         $items=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=>mfCOntext::getInstance()->getUser()->getLanguage()))
                ->setQuery("SELECT ".CustomerContractStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').
                           " LEFT JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".                                                      
                           " GROUP BY ".CustomerContractStatusI18n::getTableField('id').
                           " ORDER BY value ASC".                            
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows()){
            $cache->register(serialize($items));
            return $items;
        }       
        while ($item=$db->fetchObject('CustomerContractStatusI18n'))
        {                     
                $items[$item->get('status_id')]=$item->get('value');          
        }
        $cache->register(serialize($items));
        return $items;
    }    
    
    
     static function getCompaniesForSelect(ConditionsQuery $where,$user,$site=null)
    {     
         $cache= new mfCacheFile('companies.contract.conditions.'.md5($where->getWhere(),$user->hasCredential(array(array('contract_filter_equal_company_active')))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());   

        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".CustomerContractCompany::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('company_id').                            
                           " WHERE ".CustomerContractCompany::getTableField('id')." IS NOT NULL ".
                                    ($user->hasCredential(array(array('contract_filter_equal_company_active')))?" AND ".CustomerContractCompanyCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".CustomerContractCompany::getTableField('id').
                           " ORDER BY ".CustomerContractCompany::getTableField('name')." ASC ".                          
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
         {
             $cache->register(serialize(array()));
            return array();
        }      
        $items=array();
        while ($item=$db->fetchObject('CustomerContractCompany'))
        {                              
            $items[$item->get('id')]=strtoupper($item->get('name'));
        } 
        $cache->register(serialize($items));
        return $items;
    }  
    
    static function getCompanies(ConditionsQuery $where,$user,$site=null)
    {        
        $cache= new mfCacheFile('companies.contract.conditions.select2.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".CustomerContractCompany::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('company_id').($user->hasCredential(array(array('contract_filter_in_company_active')))?" AND ".CustomerContractCompany::getTableField('is_active')."='YES' ":"").                            
                           " WHERE ".CustomerContractCompany::getTableField('id')." IS NOT NULL ".
                                    //($user->hasCredential(array(array('contract_filter_in_company_active')))?" AND ".CustomerContractCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".CustomerContractCompany::getTableField('id').
                           " ORDER BY ".CustomerContractCompany::getTableField('name')." ASC ".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }        
        $item=new CustomerContractCompany(null,$site);        
        $items=array('NULL'=>$item);
        while ($item=$db->fetchObject('CustomerContractCompany'))
        {                                              
             $items[$item->get('id')]=$item->loaded();          
        }         
        $cache->register(serialize($items));
        return $items;
    } 
    
     static function getSalesUsers1ForSelect2(ConditionsQuery $where,$user,$site=null)
    {            
        $cache= new mfCacheFile('users.sales1.conditions.select2.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_1_id').
                           ($user->hasCredential(array(array('contract_filter_equal_sale1_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active,UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   echo $db->getQuery();
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
           return array();
        }
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=$user;
        } 
        $cache->register(serialize($users));
        return $users;
    }           
    
     static function getSalesUsers2ForSelect2(ConditionsQuery $where,$user,$site=null)
    {      
        $cache= new mfCacheFile('users.sales2.conditions.select2.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_2_id').
                           ($user->hasCredential(array(array('contract_filter_equal_sale2_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active,UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
           return array();
        }
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=$user;
        }     
        $cache->register(serialize($users));
        return $users;
    } 
    
     static function getTeleproUsersForSelect2(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.telepro.conditions.select2.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('telepro_id').
                           ($user->hasCredential(array(array('contract_filter_equal_telepro_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active,UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")                                                        
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=$user;
        } 
        $cache->register(serialize($users));
        return $users;
    }

   static function getPollutersForSelect2(ConditionsQuery $where,$user,$site=null)
    {       
        $cache= new mfCacheFile('polluters.conditions.select2.'.md5($lang.$where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());      
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".PartnerPolluterCompany::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('polluter_id').                                                      
                           " WHERE ".PartnerPolluterCompany::getTableField('id')." IS NOT NULL ".
                                    ($user->hasCredential(array(array('superadmin','contract_filter_equal_polluter_active')))?" AND ".PartnerPolluterCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".PartnerPolluterCompany::getTableField('id').
                           " ORDER BY is_active ,".PartnerPolluterCompany::getTableField('name')." ASC ".                          
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return array();        
        }
        $items=array();
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {                              
            $items[$item->get('id')]=$item;
        }
        $cache->register(serialize($items));
        return $items;
    } 
    
    static function getAssistantUsersForSelect2(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.assistant.conditions.select2.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());      
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('assistant_id').                                                
                           ($user->hasCredential(array(array('contract_filter_equal_assistant_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active,UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site);        
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return array();        
        }
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]= $user;
        }            
        $cache->register(serialize($users));
        return $users;
    }
    
    
     static function getReferencesForSelect(ConditionsQuery $where,$user,$limit=10,$site=null)
    {       
        $items=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())    
                ->setParameter('limit',$limit)        
                ->setQuery("SELECT DISTINCT ". CustomerContract::getTableField('reference')." FROM ".CustomerContract::getTable().
                        " WHERE ".CustomerContract::getTableField('reference')." !='' ".
                                    $where->getWhere("AND").
                        " GROUP BY reference".
                        " ORDER BY reference ASC ".                          
                        " LIMIT 0,{limit} ".  
                        ";")               
                ->makeSiteSqlQuery($site);         
        if (!$db->getNumRows())
            return $items;         
        while ($row=$db->fetchRow())
        {                              
            $items[$row[0]]=strtoupper($row[0]);
        }      
        return $items;
    } 
    
   static function createDefaultProductForContracts(Product $product)
    {      
       $site=$product->getSite();
       
        // Create Products for meetings
       CustomerMeetingUtils::createDefaultProductForContracts($product,$site);  
         
         
       $products_by_default=ProductSettings::load($site)->getDefaultContractProductsById();
       if (!in_array($product->get('id'),$products_by_default))
               return ;
              
         
        // Manage contracts without products
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('product_id'=>$product->get('id')))                
                ->setQuery("SELECT ".CustomerContract::getTableField('id')." FROM ".CustomerContract::getTable(). 
                           " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id')." AND ".CustomerContractProduct::getTableField('product_id')."='{product_id}'".  
                           " WHERE  ".CustomerContractProduct::getTableField('id')." IS NULL".
                                    " AND is_hold='NO'".
                           " LIMIT 0,500".
                           ";")               
                ->makeSiteSqlQuery($site);  
        /*if (!$db->getNumRows())
           return ;*/
       //      echo $db->getQuery();
        $collection=new CustomerContractProductCollection(null,$site);
        while ($row=$db->fetchArray())
        {                                                              
                $item=new CustomerContractProduct(null,$site);
                $item->add(array('product_id'=>$product,'contract_id'=>$row['id']));
                $collection[]=$item;         
        } 
        $collection->save();      
        

    }    
    
    
     static function getUsers($site=null)
    {                    
        $users=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('telepro_id').                        
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active,UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return $users;        
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=$user;
        }     
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('sale_1_id').  
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active,UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return $users;        
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=$user;
        }    
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('sale_2_id').  
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active,UPPER(lastname) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return $users;        
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=$user;
        }    
        return $users;
    }    
    
    
    static function getStatesFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>$pager->getUser()->getLanguage()))
                ->setObjects(array('CustomerContractStatus','CustomerContractStatusI18n'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContractStatus::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('state_id').
                           " LEFT JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id')." AND lang='{}'"     .
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('contract_id')]))
               continue;           
           if ($items->hasCustomerContractStatus())
                $pager[$items->get('contract_id')]->set('state_id',$items->getCustomerContractStatus()->setI18n($items->hasCustomerContractStatusI18n()?$items->getCustomerContractStatusI18n():false));
           else
               $pager[$items->get('contract_id')]->set('state_id',false);
        }        
    }
    
    static function getInstallStatesFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>$pager->getUser()->getLanguage()))
                ->setObjects(array('CustomerContractInstallStatus','CustomerContractInstallStatusI18n'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContractInstallStatus::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('install_state_id').
                           " LEFT JOIN ".CustomerContractInstallStatusI18n::getInnerForJoin('status_id')." AND lang='{}'"     .
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('contract_id')]))
               continue;     
           if ($items->hasCustomerContractInstallStatus())
               $pager[$items->get('contract_id')]->set('install_state_id',$items->getCustomerContractInstallStatus()->setI18n($items->hasCustomerContractInstallStatusI18n()?$items->getCustomerContractInstallStatusI18n():false));
           else
               $pager[$items->get('contract_id')]->set('install_state_id',false);
        }        
    }
    
    
    static function getRangesFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>$pager->getUser()->getLanguage()))
                ->setObjects(array('CustomerContractRange','CustomerContractRangeI18n'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContractRange::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('opc_range_id').
                           " LEFT JOIN ".CustomerContractRangeI18n::getInnerForJoin('range_id')." AND lang='{lang}'"     .
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('contract_id')]))
               continue;     
           if ($items->hasCustomerContractRange())
               $pager[$items->get('contract_id')]->set('opc_range_id',$items->getCustomerContractRange()->setI18n($items->hasCustomerContractRangeI18n()?$items->getCustomerContractRangeI18n():false));
           else
               $pager[$items->get('contract_id')]->set('opc_range_id',false);
        }        
    }
    
    static function getOpcStatesFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>$pager->getUser()->getLanguage()))
                ->setObjects(array('CustomerContractOpcStatus','CustomerContractOpcStatusI18n'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContractOpcStatus::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('opc_status_id').
                           " LEFT JOIN ".CustomerContractOpcStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'"     .
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('contract_id')]))
               continue;     
           if ($items->hasCustomerContractOpcStatus())
               $pager[$items->get('contract_id')]->set('opc_status_id',$items->getCustomerContractOpcStatus()->setI18n($items->hasCustomerContractOpcStatusI18n()?$items->getCustomerContractOpcStatusI18n():false));
           else
               $pager[$items->get('contract_id')]->set('opc_status_id',false);
        }        
    }
    
    
    static function getUsersByFieldFromPager($field,$pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('User'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".User::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin($field).                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('contract_id')]))
               continue;           
           $pager[$items->get('contract_id')]->set($field,$items->hasUser()?$items->getUser():false);
        }        
    }
    
    
     static function getTeamsFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('UserTeam'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".UserTeam::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('team_id').                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('contract_id')]))
               continue;           
           $pager[$items->get('contract_id')]->set('team_id',$items->hasUserTeam()?$items->getUserTeam():false);
        }        
    }
    
    static function getPollutersFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('PartnerPolluterCompany'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".PartnerPolluterCompany::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('polluter_id').                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('contract_id')]))
               continue;           
           $pager[$items->get('contract_id')]->set('polluter_id',$items->hasPartnerPolluterCompany()?$items->getPartnerPolluterCompany():false);
        }        
    }
    
    
     static function getFinancialsFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('Partner'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".Partner::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('financial_partner_id').                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('contract_id')]))
               continue;           
           $pager[$items->get('contract_id')]->set('financial_partner_id',$items->hasPartner()?$items->getPartner():false);
        }        
    }
    
     static function getLayersFromPager($pager)
    {       
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('PartnerLayerCompany'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".PartnerLayerCompany::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('partner_layer_id').                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('contract_id')]))
               continue;           
           $pager[$items->get('contract_id')]->set('partner_layer_id',$items->hasPartnerLayerCompany()?$items->getPartnerLayerCompany():false);
        }        
    }
    
     static function getCompaniesFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('CustomerContractCompany'))
                ->setQuery("SELECT {fields},".CustomerContract::getTableField('id')." as contract_id FROM ".CustomerContractCompany::getTable().
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('company_id').                         
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('contract_id')]))
               continue;           
           $pager[$items->get('contract_id')]->set('company_id',$items->hasCustomerContractCompany()?$items->getCustomerContractCompany():false);
        }        
    }
      
}

