<?php



class CustomerMeetingUtilsBase {
  
    
    static function getTeleproUsersForSelect(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.telepro.meeting.select.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').($user->hasCredential(array(array('meeting_filter_equal_telepro_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id').
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " LEFT JOIN ".UserFunctionI18n::getInnerForJoin('function_id').
                            ($user->hasCredential(array(array('meeting_filter_equal_telepro_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
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
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }     
        $cache->register(serialize($users));
        return $users;
    }      
    
    static function getCampaignsForSelect(ConditionsQuery $where,$site=null)
    { 
        $cache= new mfCacheFile('meeting_campaigns.select.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id')),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".CustomerMeetingCampaign::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('campaign_id').                         
                            $where->getWhere().
                           " GROUP BY ".CustomerMeetingCampaign::getTableField('id').
                           " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerMeetingCampaign'))
        {
           $items[$item->get('id')]=strtoupper($item->get('name'));
        }     
        $cache->register(serialize($items));
        return $items;
    }      
    
    static function getCampaigns(ConditionsQuery $where,$site=null)
    {        
        $cache= new mfCacheFile('meeting_campaigns.conditions.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id')),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".CustomerMeetingCampaign::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('campaign_id').     
                           $where->getWhere().
                           " GROUP BY ".CustomerMeetingCampaign::getTableField('id').
                           " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerMeetingCampaign'))
        {
           if ($item->get('id'))
               $item->loaded();
           $items[$item->get('id')]= $item;
        }
        $cache->register(serialize($items));
        return $items;
    }  
    
    static function getAssistantUsersForSelect(ConditionsQuery $where,$user,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('assistant_id').                                                
                           ($user->hasCredential(array(array('meeting_filter_equal_assistant_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
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
    
    static function getSalesUsersForSelect(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.sale1.meeting.select.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').($user->hasCredential(array(array('meeting_filter_equal_sale1_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sales_id').
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " LEFT JOIN ".UserFunctionI18n::getInnerForJoin('function_id'). 
                            ($user->hasCredential(array(array('meeting_filter_equal_sale1_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
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
    
    static function getSalesUsers2ForSelect(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.sale2.select.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').($user->hasCredential(array(array('meeting_filter_equal_sale1_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sale2_id').
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " LEFT JOIN ".UserFunctionI18n::getInnerForJoin('function_id'). 
                             ($user->hasCredential(array(array('meeting_filter_equal_sale2_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
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
    
     
    
    static function getStatusForSelect($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('meeting_state.select.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id')),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerMeetingStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id').
                           " LEFT JOIN ".CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".   
                           $where->getWhere().
                           " GROUP BY ".CustomerMeetingStatusI18n::getTableField('id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerMeetingStatusI18n'))
        {
           $items[$item->get('status_id')]=$item->get('value');
        } 
        $cache->register(serialize($items));
        return $items;
    }      
    
    static function getTeleproUsers(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.telepro.meeting.conditions.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').($user->hasCredential(array(array('meeting_filter_in_telepro_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id').($user->hasCredential(array(array('meeting_filter_in_telepro_active')))?" AND ".User::getTableField('is_active')."='YES'":"").     
                           //($user->hasCredential(array(array('meeting_filter_in_telepro_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                            $where->getWhere().
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active, UPPER(lastname) COLLATE utf8_general_ci ASC ".
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
           $users[$user->get('id')]= $user;
        }
        $cache->register(serialize($users));
        return $users;
    }   
        
    
    static function getSalesUsers(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.sale1.meeting.conditions.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').($user->hasCredential(array(array('meeting_filter_in_sale1_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sales_id').($user->hasCredential(array(array('meeting_filter_in_sale1_active')))?" AND ".User::getTableField('is_active')."='YES'":""). 
                           //($user->hasCredential(array(array('meeting_filter_in_sale1_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
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
        $cache= new mfCacheFile('users.sale2.meeting.conditions.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').($user->hasCredential(array(array('meeting_filter_in_sale2_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sale2_id').($user->hasCredential(array(array('meeting_filter_in_sale2_active')))?" AND ".User::getTableField('is_active')."='YES'":"").    
                            //($user->hasCredential(array(array('meeting_filter_in_sale2_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
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
    
    static function getAssistantUsers(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.assistant.meeting.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').($user->hasCredential(array(array('meeting_filter_in_assistant_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('assistant_id').($user->hasCredential(array(array('meeting_filter_in_assistant_active')))?" AND ".User::getTableField('is_active')."='YES'":"").    
                           //($user->hasCredential(array(array('meeting_filter_in_assistant_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
                            $where->getWhere().
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY is_active, UPPER(lastname) COLLATE utf8_general_ci ASC ".
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
    
    
    static function getStates($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('meeting_state.select.in.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerMeetingStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id').
                           " LEFT JOIN ".CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'". 
                           $where->getWhere().   
                           " GROUP BY ".CustomerMeetingStatusI18n::getTableField('status_id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return array();
        }
        $states=array();
        while ($state=$db->fetchObject('CustomerMeetingStatusI18n'))
        {
           if ($state->get('id'))
               $state->loaded();
           $states[$state->get('status_id')]=$state;
        }  
        $cache->register(serialize($states));
        return $states;
    }   
    
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
                ->makeSiteSqlQuery($site); 
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
    }  
    
    
    static function getTeams(ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('users.team.meeting.conditions.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id')),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id').    
                           " LEFT JOIN ".UserTeamUsers::getInnerForJoin('user_id').    
                           " LEFT JOIN ".UserTeamUsers::getOuterForJoin('team_id').   
                         //  " WHERE ".UserTeam::getTableField('id')." IS NOT NULL ".
                          // $where->getWhere('AND').
                          $where->getWhere().
                           " GROUP BY ".UserTeam::getTableField('id').
                           " ORDER BY ".UserTeam::getTableField('name')." ASC ".
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
           if ($team->get('id'))
               $team->loaded();
           else
               $team->id='IS_NULL';
           $teams[$team->get('id')]=$team;
        }      
        $cache->register(serialize($teams));
        return $teams;
    }
    
    static function getCommentsFromPager($pager)
    {              
       if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT * FROM ".CustomerMeetingComment::getTable().                           
                           " WHERE ".CustomerMeetingComment::getTableField('meeting_id')." IN(".implode(",",array_keys($pager->getItems())).") AND type !='LOG'".
                           " ORDER BY created_at DESC ".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
        if (!$db->getNumRows())
            return array();        
        while ($item=$db->fetchObject('CustomerMeetingComment'))
        {                            
            $pager->items[$item->get('meeting_id')]->comments[]=$item;
        }               
    } 
    
    
    static function getTeleproUsersWithMeeting(ConditionsQuery $where,$site=null)
    {       
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('telepro_id').     
                           $where->getWhere().
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY ".User::getTableField('lastname').",".User::getTableField('firstname').
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
          // if ($user->get('id'))
         //      $user->loaded();
           $users[$user->get('id')]=$user->loaded();
        }
        return $users;
    } 
    
    static function getSalesUser1WithMeeting(ConditionsQuery $where,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('sales_id'). 
                           $where->getWhere().
                           " GROUP BY ".User::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {           
           $users[$user->get('id')]=$user->loaded();
        }
        return $users;
    }   
    
    static function getSalesUsers2WithMeeting(ConditionsQuery $where,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('sale2_id'). 
                           $where->getWhere().
                           " GROUP BY ".User::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {           
           $users[$user->get('id')]=$user->loaded();
        }
        return $users;
    }   
    
    static function getAssistantWithMeting(ConditionsQuery $where,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('assistant_id'). 
                           $where->getWhere().
                           " GROUP BY ".User::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {           
           $users[$user->get('id')]=$user->loaded();
        }        
        return $users;
    }   
    
    static function getNumberOfMeetingMax($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()                
                ->setQuery("SELECT ".
                    " (SELECT count(".CustomerMeeting::getTableField('id').") FROM ".User::getTable()." AS user2 ".
                    " LEFT JOIN ".CustomerMeeting::getTable()." ON ".CustomerMeeting::getTableField('telepro_id')."=user2.id OR ".
                                    CustomerMeeting::getTableField('sales_id')."=user2.id OR ".
                                    CustomerMeeting::getTableField('sale2_id')."=user2.id ".
                    " WHERE ".CustomerMeeting::getTableField('status')."='ACTIVE' AND user2.id=user1.id GROUP BY user2.id ) as count_user".                 
                    " FROM ".User::getTable()." AS user1 LEFT JOIN ".CustomerMeeting::getTable()." ON ".CustomerMeeting::getTableField('telepro_id')."=user1.id OR ".
                                CustomerMeeting::getTableField('sales_id')."=user1.id OR ".
                                CustomerMeeting::getTableField('sale2_id')."=user1.id ".
                    " WHERE ".CustomerMeeting::getTableField('status')."='ACTIVE' ".                   
                    " ORDER BY count_user DESC LIMIT 0,1".
                    ";")                                                        
                ->makeSiteSqlQuery($site); 
        $row=$db->fetchArray();
        return $row['count_user'];                         
    }
    
    static function getNumberOfMeetingMin($site=null)
    {
         $db=mfSiteDatabase::getInstance()
                ->setParameters()                
                ->setQuery("SELECT ".
                    " (SELECT count(".CustomerMeeting::getTableField('id').") FROM ".User::getTable()." AS user2 ".
                    " LEFT JOIN ".CustomerMeeting::getTable()." ON ".CustomerMeeting::getTableField('telepro_id')."=user2.id OR ".
                                    CustomerMeeting::getTableField('sales_id')."=user2.id OR ".
                                    CustomerMeeting::getTableField('sale2_id')."=user2.id ".
                    " WHERE ".CustomerMeeting::getTableField('status')."='ACTIVE' AND user2.id=user1.id GROUP BY user2.id ) as count_user".                 
                    " FROM ".User::getTable()." AS user1 LEFT JOIN ".CustomerMeeting::getTable()." ON ".CustomerMeeting::getTableField('telepro_id')."=user1.id OR ".
                                CustomerMeeting::getTableField('sales_id')."=user1.id OR ".
                                CustomerMeeting::getTableField('sale2_id')."=user1.id ".
                    " WHERE ".CustomerMeeting::getTableField('status')."='ACTIVE' ".                  
                    " ORDER BY count_user ASC LIMIT 0,1".
                    ";")                                                        
                ->makeSiteSqlQuery($site); 
        $row=$db->fetchArray();
        return $row['count_user'];      
    }
    
    static function getRatioMax($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()                
                ->setQuery("SELECT ".
                    " (SELECT count(".CustomerMeeting::getTableField('id').") FROM ".User::getTable()." AS user2 ".
                    " LEFT JOIN ".CustomerMeeting::getTable()." ON ".CustomerMeeting::getTableField('telepro_id')."=user2.id OR ".
                                    CustomerMeeting::getTableField('sales_id')."=user2.id OR ".
                                    CustomerMeeting::getTableField('sale2_id')."=user2.id ".
                    " WHERE ".CustomerMeeting::getTableField('status')."='ACTIVE' AND user2.id=user1.id GROUP BY user2.id ) as count_user".                 
                    " FROM ".User::getTable()." AS user1 LEFT JOIN ".CustomerMeeting::getTable()." ON ".CustomerMeeting::getTableField('telepro_id')."=user1.id OR ".
                                CustomerMeeting::getTableField('sales_id')."=user1.id OR ".
                                CustomerMeeting::getTableField('sale2_id')."=user1.id ".
                    " WHERE ".CustomerMeeting::getTableField('status')."='ACTIVE' ".                   
                    " ORDER BY count_user DESC LIMIT 0,1".
                    ";")                                                        
                ->makeSiteSqlQuery($site); 
        $row=$db->fetchArray();
        return $row['ratio_user'];                         
    }
    
    static function getRatioMin($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()                
                ->setQuery("SELECT ".
                    " (SELECT count(".CustomerMeeting::getTableField('id').") FROM ".User::getTable()." AS user2 ".
                    " LEFT JOIN ".CustomerMeeting::getTable()." ON ".CustomerMeeting::getTableField('telepro_id')."=user2.id OR ".
                                    CustomerMeeting::getTableField('sales_id')."=user2.id OR ".
                                    CustomerMeeting::getTableField('sale2_id')."=user2.id ".
                    " WHERE ".CustomerMeeting::getTableField('status')."='ACTIVE' AND user2.id=user1.id GROUP BY user2.id ) as count_user".                 
                    " FROM ".User::getTable()." AS user1 LEFT JOIN ".CustomerMeeting::getTable()." ON ".CustomerMeeting::getTableField('telepro_id')."=user1.id OR ".
                                CustomerMeeting::getTableField('sales_id')."=user1.id OR ".
                                CustomerMeeting::getTableField('sale2_id')."=user1.id ".
                    " WHERE ".CustomerMeeting::getTableField('status')."='ACTIVE' ".                   
                    " ORDER BY count_user DESC LIMIT 0,1".
                    ";")                                                        
                ->makeSiteSqlQuery($site); 
        $row=$db->fetchArray();
        return $row['ratio_user'];                         
    }
    
    static function processSelection($actions,$selection,$parameters=array(),$user,$site=null)
    {
        //  echo "<pre>"; var_dump($actions,$selection); echo "</pre>";
        $query=array();
        $params=array('is_hold'=>'NO');
        $messages=new mfArray();
        if (in_array('created_at',$actions))
        {
            if ($parameters['created_at'])
            {    
                $params['created_at']=$parameters['created_at'];
                $query[]=CustomerMeeting::getTableField("created_at")."='{created_at}'";
            }
            else
               $query[]=CustomerMeeting::getTableField("created_at")."=NULL"; 
        } 
        if (in_array('in_at',$actions))
        {            
            if ($parameters['in_at']['date'])
            {    
                $params['in_at']=$parameters['in_at'];
                $query[]=CustomerMeeting::getTableField("in_at")."='{in_at}'";
            }
            else
            {
                $query[]=CustomerMeeting::getTableField("in_at")."=NULL";
            }    
        } 
        if (in_array('telepro',$actions))
        {
            $params['telepro_id']=$parameters['telepro_id'];
            $query[]=CustomerMeeting::getTableField("telepro_id")."='{telepro_id}'";
        } 
         if (in_array('sale1',$actions))
        {
            $params['sales_id']=$parameters['sales_id'];
            $query[]=CustomerMeeting::getTableField("sales_id")."='{sales_id}'";
        } 
        if (in_array('sale2',$actions))
        {
            $params['sale2_id']=$parameters['sale2_id'];
            $query[]=CustomerMeeting::getTableField("sale2_id")."='{sale2_id}'";
        } 
         if (in_array('state',$actions))
        {
            $params['state_id']=$parameters['state_id'];
            $query[]=CustomerMeeting::getTableField("state_id")."='{state_id}'";
        } 
        if (in_array('assistant',$actions))
        {           
            $params['assistant_id']=$parameters['assistant_id'];
            $query[]=CustomerMeeting::getTableField("assistant_id")."='{assistant_id}'";
        }   
         if (in_array('campaign',$actions))
        {           
            $params['campaign_id']=$parameters['campaign_id'];
            $query[]=CustomerMeeting::getTableField("campaign_id")."='{campaign_id}'";
        }  
         if (in_array('type',$actions))
        {           
            $params['type_id']=$parameters['type_id'];
            $query[]=CustomerMeeting::getTableField("type_id")."='{type_id}'";
        }  
        if (in_array('sms_customer',$actions))
        {
           //echo "<pre>"; var_dump($selection,$parameters); echo "<pre>";
            self::sendSmsModelMultipleMeetings($selection,new CustomerModelSmsI18n($parameters['sms_customer_model_id']),$site);
        } 
        if (in_array('email_customer',$actions))
        {
           //echo "<pre>"; var_dump($selection,$parameters); echo "<pre>";
            $errors=self::sendEmailModelMultipleMeetings($selection,new CustomerModelEmailI18n($parameters['email_customer_model_id']),$site);
            $messages=array_merge($messages,$errors);
            $messages[]=__("Emails are in spooler.");
        } 
        if (in_array('email_sale1',$actions))
        {
         //  echo "<pre>"; var_dump($parameters['email_sale1_model_id']); echo "<pre>";
            $errors=self::sendEmailSale1ModelMultipleMeetings($selection,new UserModelEmailI18n($parameters['email_sale1_model_id'],$site),$site);
            $messages=array_merge($messages,$errors);
            $messages[]=__("Emails for sale1 are in spooler.");
        } 
        if (in_array('email_sale2',$actions))
        {
           //echo "<pre>"; var_dump($selection,$parameters); echo "<pre>";
            $errors=self::sendEmailSale2ModelMultipleMeetings($selection,new UserModelEmailI18n($parameters['email_sale2_model_id'],$site),$site);
            $messages=array_merge($messages,$errors);
            $messages[]=__("Emails for sale2 are in spooler.");
        } 
        if (in_array('products_by_default',$actions))
        {
           self::createDefaultProductsForMultipleMeetings($selection,$site);  
        }
       /* if (in_array('create_contract',$actions))
        {
           $messages[]=self::createContracts($selection,$user,$site);  
        } */ 
         if (in_array('polluter',$actions))
        {           
            $params['polluter_id']=$parameters['polluter_id'];
            $query[]=CustomerMeeting::getTableField("polluter_id")."='{polluter_id}'";
            $messages[]=__("Polluter has been updated.");
        }  
        if (in_array('generate_coordinates',$actions))
        {                       
            $messages->merge(self::generateCoordinates($selection,$site));
        }
         if (in_array('remove_remarks',$actions))
        {                       
            $query[]=CustomerMeeting::getTableField("remarks")."=''";
            $messages[]=__("Remark has been removed.");
        }
         if (in_array('treated_at',$actions))
        {
            // var_dump($parameters['treated_at']);
             if ($parameters['treated_at']===null)
                $query[]=CustomerMeeting::getTableField("treated_at")."=NULL";
             else
             {    
              $params['treated_at']=$parameters['treated_at'];
              $query[]=CustomerMeeting::getTableField("created_at")."='{treated_at}'";            
             }
              $messages[]=__("Treated date has been updated.");
        }
        if (in_array('callcenter',$actions))
        {           
            $params['callcenter_id']=$parameters['callcenter_id'];
            $query[]=CustomerMeeting::getTableField("callcenter_id")."='{callcenter_id}'";
            $messages[]=__("Callcenter has been updated.");
        } 
        if (in_array('status_callcenter',$actions))
        {
             $params['status_call_id']=$parameters['status_call_id'];
             $query[]=CustomerMeeting::getTableField("status_call_id")."='{status_call_id}'";
             $messages[]=__("Status call center has been updated.");
        }      
        if (in_array('opc_at_equal_in_at',$actions))
        {
            self::setOpcAtEqualInAt($selection,$site);
            $messages[]=__("Date OPC = Meeting date has been updated.");
        }        
        if (in_array('opc_at_time_to_range',$actions))
        {
            self::setOpcAtTimeToRange($selection,$site);
            $messages[]=__("Time OPC date to range has been updated.");
        } 
        if (in_array('in_at_time_to_range',$actions))
        {
            self::setInAtTimeToRange($selection,$site);
            $messages[]=__("Meeting time to range has been updated.");
        } 
           if (in_array("contract_sale2",$actions))
        {            
            CustomerMeetingUtils::updateSale2ForContracts($selection,$parameters,$site);
            $messages[]=__("Sale2 of contract has been updated.");
        }     
          if (in_array("multiple_remove",$actions))
        {            
            $messages->merge(CustomerMeetingUtils::removeMeetings($selection,$site));            
        }  
      //  echo "<pre>"; var_dump($query,$params,$selection); echo "</pre>";
        if ($query)
        {           
           $db=mfSiteDatabase::getInstance()
                ->setParameters($params)                
                ->setQuery("UPDATE ".CustomerMeeting::getTable().
                           " SET ".implode(",",$query).
                           " WHERE id IN('".$selection->implode("','")."')".
                                " AND is_hold='{is_hold}'".
                           ";")                                                        
                ->makeSiteSqlQuery($site); 
        //  echo $db->getQuery();
        }  
        CustomerMeetingUtils::setCacheForMeetingMultipleUpdate($params,$site);       
        return $messages;
    }  
        
    static function setCacheForMeetingMultipleUpdate($params,$site=null){
               
        foreach (array(
            'telepro_id'=>array('users','meeting_state'),
            'sales_id'=>array('users','meeting_state'),
            'sale2_id'=>array('users','meeting_state'),
            'team_id'=>array('users','meeting_state'),
            'state_id'=>'meeting_state',
            'assistant_id'=>array('users','meeting_state'),
            'campaign_id'=>'meeting_campaigns',
            'callcenter_id'=>'callcenters',
            'status_call_id'=>'meeting_call_status',
            'status_lead_id'=>'meeting_status_lead',
            'type_id'=>'meeting_type',
            'polluter_id'=>'polluters',
            'opc_range_id'=>'range',
            'partner_layer_id'=>'layers',
            'company_id'=>'companies',
        ) as $name=>$_cache)
        {
            if(!array_key_exists($name, $params))
                continue;
               // echo "Name=".$name."<br/>";
            foreach ((array)$_cache as $cache)
                mfCacheFile::removeCache($cache,'admin',$site);                
        }
    }
    
    static function getUserLocksFromPager($pager)
    {        
        $settings=  CustomerMeetingSettings::load($pager->getSite());
        if (!$settings->hasLock())
            return null;
        if (!$pager->hasItems())
            return null;        
       $current_user=  mfcontext::getInstance()->getUser()->getGuardUser();
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable().",".CustomerMeeting::getTableField('id')." as meeting_id".                             
                           " FROM ".User::getTable().                           
                           " INNER JOIN ".CustomerMeeting::getInnerForJoin('lock_user_id').
                           " WHERE ".CustomerMeeting::getTableField('id')." IN(".implode(",",array_keys($pager->getItems())).")".                                                               
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
        if (!$db->getNumRows())
            return null;                  
        while ($item=$db->fetchObject('User'))
        {                            
            $pager->items[$item->get('meeting_id')]->set('lock_user_id',$item);
        }  
        // Find if owner
        foreach ($pager->items as $item)
        {
            if ($item->hasUserLock() || $item->isLocked())
            {    
                $item->is_lock_owner=($item->get('lock_user_id')==$current_user->get('id'));                   
            }    
        }    
    }
    
    
    static function releaseLocksForUser($user)
    {
       $db=mfSiteDatabase::getInstance()
            ->setParameters(array('lock_user_id'=>$user->get('id')))   
            ->setQuery("UPDATE ".CustomerMeeting::getTable().
                        " SET lock_time=NULL,lock_user_id=0,is_locked='NO'" .
                        " WHERE lock_user_id  ='{lock_user_id}' ;")
          ->makeSiteSqlQuery($user->getSite());  
    }
    
    static function cleanLocks($meeting)
    {
        $settings=CustomerMeetingSettings::load($meeting->getSite());         
        $time_over=date("Y-m-d H:i:s",time()- ($settings->get('lock_time_out',60)));          
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('time_over'=>$time_over))   
            ->setQuery("UPDATE ".CustomerMeeting::getTable().
                        " SET lock_time=NULL,lock_user_id=0,is_locked='NO'" .
                        " WHERE lock_time  <='{time_over}' ;")
          ->makeSiteSqlQuery($meeting->getSite()); 
      // echo "Time=".$time_over." Query=".$db->getQuery()."<br/>";
      //  return ; 
        // check if not timeout for current meeting
        if (!$meeting->isLocked())
            return ;               
        if ($meeting->get('lock_time') <= $time_over )      
            $meeting->unlock();        
    }
    
    static function getStateLocks($user,$selection,$site=null)
    {
        $items=array();
        if (!$selection)
            return $items;
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$user->get('id')))
                ->setQuery("SELECT ".CustomerMeeting::getTableField('id').",".CustomerMeeting::getTableField('is_locked').",lastname,firstname FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('lock_user_id').
                           " WHERE ".CustomerMeeting::getTable('lock_user_id')."!='{user_id}' ".
                                " AND ".CustomerMeeting::getTableField('id')." IN('".implode("','",$selection)."')".
                           ";")               
                ->makeSiteSqlQuery($site);         
        $index=0;
        while ($row=$db->fetchArray())
        {                            
            $items[$index]['id']=$row['id'];
            $items[$index]['state']=($row['is_locked']=='YES');
            $items[$index]['user']=strtoupper($row['lastname']." ".$row['firstname']); 
            $index++;
        }  
        return $items;
    }        
    
    
    static function isMeetingExist($in_at,$phone,$site=null)
    {
       $db=mfSiteDatabase::getInstance()
                ->setParameters(array('in_at'=>$in_at,'phone'=>$phone))
                ->setQuery("SELECT ".CustomerMeeting::getTableField('id')." FROM ".CustomerMeeting::getTable().
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('customer_id').                                                
                           " WHERE ".CustomerMeeting::getTableField('in_at')."='{in_at}' AND ".Customer::getTableField('phone')."='{phone}'".                                              
                           " LIMIT 1".
                           ";")               
                ->makeSiteSqlQuery($site); 
        return $db->getNumRows();            
        
    }     
    
    
    static function getMeetingsFromSelection(mfArray $selection,$site=null)
    {
        $collection=new CustomerMeetingCollection(null,$site);
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT * FROM ".CustomerMeeting::getTable().                                                                  
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."')".                                                                     
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $collection;                  
        while ($item=$db->fetchObject('CustomerMeeting'))
        {                            
            $collection[]=$item->loaded()->setSite($site);
        }  
        return $collection;
    }     
    
    static function getConditionsFromUserCredentials($user,$site=null)
    {
       $where="";
       $settings=CustomerMeetingSettings::load($site);
       if ($user->hasCredential(array(array('filter_meeting_telepro','filter_meeting_telepro_list'))))                    
           $where=CustomerMeeting::getTableField('telepro_id')."={user_id} ";                  
       elseif ($user->hasCredential(array(array('filter_meeting_commercial','filter_meeting_commercial_list'))))   
       {                  
           $where="(".CustomerMeeting::getTableField('sales_id')."={user_id} OR ".CustomerMeeting::getTableField('sale2_id')."={user_id})";          
       }     
       elseif ($user->hasCredential(array(array('filter_meeting_telepro_manager','filter_meeting_telepro_manager_list'))))
       {              
           $team_users=$user->getGuardUser()->getTeamUsers();                
           $condition=$team_users->isEmpty()?" IS NULL":" IN('".$team_users->getKeys()->implode("','")."')"; 
           $where=CustomerMeeting::getTableField('telepro_id').$condition;                            
       } 
       elseif ($user->hasCredential(array(array('filter_meeting_sales_manager','filter_meeting_sales_manager_list'))))
       {       
            $team_users=$user->getGuardUser()->getTeamUsers();                
            $condition=$team_users->isEmpty()?" IS NULL":" IN('".$team_users->getKeys()->implode("','")."')";
            $where=CustomerMeeting::getTableField('telepro_id').$condition;    
       }    
       elseif ($settings->hasAssistant() && $user->hasCredential(array(array('filter_meeting_assistant','filter_meeting_assistant_list'))))
       {
           $where=CustomerMeeting::getTableField('assistant_id')."={user_id}";
       }   
       return $where?" AND (".$where.")":"";
    }
    
    static function getCallbacks($user,$site=null)
    {        
        $settings=CustomerMeetingSettings::load($site);
        $conditions=(!$user->hasCredential([['superadmin','admin','meeting_all']]))?"":self::getConditionsFromUserCredentials($user,$site);
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$user->getGuardUser()->get('id'),
                                      'time'=>date("Y-m-d H:i:s"),
                                      'time_max'=>date("Y-m-d H:i:s",time() + ( 60 * $settings->get('callback_delay',10)))))
                ->setObjects(array('CustomerMeeting','Customer'))
                ->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().  
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('customer_id').
                           " WHERE ".CustomerMeeting::getTableField('callback_at')." IS NOT NULL  AND ".
                                CustomerMeeting::getTableField('callback_at')." <='{time_max}' AND ".
                                CustomerMeeting::getTableField('callback_at')." >='{time}' AND ".
                                CustomerMeeting::getTableField('is_callback_cancelled')."='NO' AND ".
                                CustomerMeeting::getTableField('status')."='ACTIVE'".
                                $conditions.
                           " ORDER BY callback_at ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   trigger_error($db->getQuery());
        if (!$db->getNumRows())
            return array();   
        $list=array();    
        while ($items=$db->fetchObjects())
        {     
            $item=$items->getCustomerMeeting();
            $item->set('customer_id',$items->getCustomer());
            $list[$item->get('id')]=$item->loaded()->setSite($site);
        }  
        return $list;
    }
    
    static function loadMeetingAndCustomerFromSelection($selection,$site=null)
    {
        $collection=new CustomerMeetingCollection(null,$site);
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('CustomerMeeting','Customer'))
                ->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().  
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('customer_id').
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."')".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   trigger_error($db->getQuery());
        if (!$db->getNumRows())
            return $collection;
        while ($items=$db->fetchObjects())
        {
            $item=$items->getCustomerMeeting();
            $item->set('customer_id',$items->getCustomer());
            $collection[$item->get('id')]=$item;
        }        
        return $collection;
    }        
    
    static function sendSmsModelMultipleMeetings($selection, $model_i18n,$site=null)
    {                  
          $collection_sms_sent=new CustomerSmsSentCollection(null,$site);   
          $collection_sms_log=new SmsBoxSentCollection(null,$site);   
          $action=mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();           
          foreach (self::loadMeetingAndCustomerFromSelection($selection,$site) as $meeting)
          {    
                try
                {                  
                  $message=$action->getComponent('/customers_meetings/sms', array('COMMENT'=>false,'meeting'=>$meeting,'model_i18n'=>$model_i18n))->getContent();         
                }
                catch (SmartyCompilerException $e)
                {
                    trigger_error($e->getMessage());
                    throw new mfException(__("Error Syntax in model."));              
                }               
             //   echo "Message=".$message." Phone=".$meeting->getCustomer()->get('mobile')."<br/>";
              //  echo "<pre>"; var_dump($meeting); echo "</pre>"; 
               $sms_box=new SmsBoxApi(array('callback'=>1));                             
               $sms_box->send($meeting->getCustomer()->get('mobile'),$message); // add model 
               // SMS Sent 
               $sms=new CustomerSmsSent(null,$site);
               $sms->add(array('mobile'=>$meeting->getCustomer()->get('mobile'),
                               'model_id'=>$model_i18n->get('model_id'),
                               'message'=>$message,
                               'customer_id'=>$meeting->get('customer_id')));
               $collection_sms_sent[]=$sms;   
               // Sms Log
               $sms_log = new SmsBoxSent();
               $sms_log->setResponseFromApi($meeting->getCustomer()->get('mobile'),$message,$sms_box);                                                                                     
               $collection_sms_log[]=$sms_log;
          }
          $collection_sms_sent->save();
          $collection_sms_log->save();
          
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
    
     static function getCampaignForSelect($site=null)
    {        
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT * FROM ".CustomerMeetingCampaign::getTable().                                                    
                           " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $items=array();
        while ($item=$db->fetchObject('CustomerMeetingCampaign'))
        {
           $items[$item->get('id')]=strtoupper($item->get('name'));
        }     
        return $items;
    }    
    
   static function getCallStatusForSelect($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('meeting_call_status.select.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerMeetingStatusCallI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_call_id').
                           " LEFT JOIN ".CustomerMeetingStatusCallI18n::getInnerForJoin('status_id')." AND lang='{lang}'".   
                           $where->getWhere().
                           " GROUP BY ".CustomerMeetingStatusCallI18n::getTableField('id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerMeetingStatusCallI18n'))
        {
           $items[$item->get('status_id')]=$item->get('value');
        }   
        $cache->register(serialize($items));
        return $items;
    }  
    
     static function getTypeForSelect($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('meeting_type.select.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerMeetingTypeI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('type_id').
                           " LEFT JOIN ".CustomerMeetingTypeI18n::getInnerForJoin('type_id')." AND lang='{lang}'".   
                           $where->getWhere().
                           " GROUP BY ".CustomerMeetingTypeI18n::getTableField('type_id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CustomerMeetingTypeI18n'))
        {
           $items[$item->get('type_id')]=$item->get('value');
        }    
        $cache->register(serialize($items));
        return $items;
    }  
    
    static function getLeadStatusForSelect($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('meeting_status_lead.select.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerMeetingStatusLeadI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_lead_id').
                           " LEFT JOIN ".CustomerMeetingStatusLeadI18n::getInnerForJoin('status_id')." AND lang='{lang}'".   
                           $where->getWhere().
                           " GROUP BY ".CustomerMeetingStatusLeadI18n::getTableField('status_id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }  
        $items=array();
        while ($item=$db->fetchObject('CustomerMeetingStatusLeadI18n'))
        {
           $items[$item->get('status_id')]=$item->get('value');
        }    
        $cache->register(serialize($items));
        return $items;
    }  
       
    static function getTeamsFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT GROUP_CONCAT(".UserTeam::getTableField('name')." SEPARATOR ',') as team,".
                                CustomerMeeting::getTableField('id').
                           " FROM ".UserTeam::getTable().       
                           " INNER JOIN ".UserTeamUsers::getInnerForJoin('team_id').
                           " INNER JOIN ".UserTeamUsers::getOuterForJoin('user_id').
                           " INNER JOIN ".CustomerMeeting::getInnerForJoin('telepro_id').
                           " WHERE ".CustomerMeeting::getTableField('id')." IN(".implode(",",array_keys($pager->getItems())).")".
                           " GROUP BY ".CustomerMeeting::getTableField('id').
                           " ORDER BY name ASC ".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
        if (!$db->getNumRows())
            return ;        
        while ($row=$db->fetchArray())
        {                            
            $pager->items[$row['id']]->team=$row['team'];
        }            
    }
    
    static function initializeSite($site=null)
    {
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("DELETE FROM ".CustomerMeeting::getTable().";")               
                ->makeSiteSqlQuery($site); 
           $db->setQuery("ALTER TABLE  ".CustomerMeeting::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
           
         $db->setQuery("DELETE FROM ".CustomerMeetingProduct::getTable().";")               
                ->makeSiteSqlQuery($site);  
           $db->setQuery("ALTER TABLE  ".CustomerMeetingProduct::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
           
         $db->setQuery("DELETE FROM ".Customer::getTable().";")               
                ->makeSiteSqlQuery($site); 
            $db->setQuery("ALTER TABLE  ".Customer::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
          
          
        /*  $db->setQuery("TRUNCATE ".CustomerMeetingProduct::getTable().";")               
                ->makeSiteSqlQuery($site); 
          $db->setQuery("TRUNCATE ".CustomerMeeting::getTable().";")               
                ->makeSiteSqlQuery($site); */
         $site=$site?$site:mfContext::getInstance()->getSite()->getSite();     
         mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/frontend/view/data/customers");
         mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/frontend/data/meetings");
         mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/frontend/view/meetings");
         mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/admin/data/customers");
         mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/admin/data/meetings");
         mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/admin/view/meetings");
    }
    
    
    function createDefaultProductsForMultipleMeetings($selection,$site=null)
    {       
        $products_by_default=ProductSettings::load($site)->getDefaultProductsById();
        // Manage meetings without products
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT ".CustomerMeeting::getTableField('id')." FROM ".CustomerMeeting::getTable(). 
                           " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('meeting_id').
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."')".  
                                    " AND ".CustomerMeetingProduct::getTableField('id')." IS NULL".
                                    " AND ".CustomerMeeting::getTableField('is_hold')."='NO'".
                           ";")               
                ->makeSiteSqlQuery($site); 
       //      echo $db->getQuery();
        if ($db->getNumRows())
        {
            $collection=new CustomerMeetingProductCollection(null,$site);
            while ($row=$db->fetchArray())
            {                                                   
                foreach ($products_by_default as $product_id)
                {
                    $item=new CustomerMeetingProduct(null,$site);
                    $item->add(array('product_id'=>$product_id,'meeting_id'=>$row['id']));
                    $collection[]=$item;
                }    
            } 
            $collection->save();
        }
        // add non existing products
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT ".CustomerMeeting::getTableField('id').",".
                                 " GROUP_CONCAT(". CustomerMeetingProduct::getTableField('product_id')." SEPARATOR '|') as products".
                           " FROM ".CustomerMeeting::getTable(). 
                           " INNER JOIN ".CustomerMeetingProduct::getInnerForJoin('meeting_id').
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."')".   
                           " GROUP BY ".CustomerMeeting::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($site); 
         //   echo $db->getQuery();
        if (!$db->getNumRows())
            return ;   
        $collection=new CustomerMeetingProductCollection(null,$site);        
        while ($row=$db->fetchArray())
        {     
            $products= explode("|", $row['products']);                
            foreach ($products_by_default as $product_id)
            {
               if (in_array($product_id,$products))
                   continue;               
                $item=new CustomerMeetingProduct(null,$site);
                $item->add(array('product_id'=>$product_id,'meeting_id'=>$row['id']));
                $collection[]=$item;
            }   
        } 
        $collection->save();
        // Update status active
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("UPDATE ".CustomerMeetingProduct::getTable()." SET status='ACTIVE'".
                           " WHERE ".CustomerMeetingProduct::getTableField('meeting_id')." IN('".$selection->implode("','")."')".                                      
                           ";")               
                ->makeSiteSqlQuery($site);                 
    }        
    
    
    static function createContracts($selection,$user,$site=null)
    {
        // find meeting with no contract
         $db=new mfSiteDatabase();
                $db->setParameters(array())                
                ->setQuery("SELECT ".CustomerMeeting::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable(). 
                           " LEFT JOIN ".CustomerContract::getInnerForJoin('meeting_id').
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."')".  
                                    " AND ".CustomerContract::getTableField('id')." IS NULL".
                                    " AND ".CustomerMeeting::getTableField('is_hold')."='NO'".
                           ";")               
                ->makeSiteSqlQuery($site); 
              //  echo $db->getQuery();
        if ($db->getNumRows())
        {
           $index=0;
           $contract_settings=CustomerContractSettings::load($site);
           while ($item=$db->fetchObject('CustomerMeeting'))
           {                     
                $contract=new CustomerContract(null,$site);                           
                $contract->set('state_id',$contract_settings->get('default_status_id'));
                $contract->set('meeting_id',$item->loaded()->setSite($site));
                $contract->toContract($user);                       
                $index++;              
           }                                 
           return __("[%s] Contracts have been created",$index);
        }                        
        return __("No contract has been created");
    }        
    
     static function getProductsForSelect($name,ConditionsQuery $where,$site=null)
    {       
        $cache= new mfCacheFile('products.meeting.conditions.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id')),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());   
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".CustomerMeetingProduct::getTable().
                           " LEFT JOIN ".CustomerMeetingProduct::getOuterForJoin('product_id').  
                           " LEFT JOIN ".CustomerMeetingProduct::getOuterForJoin('meeting_id').  
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
    
    
    static function sendEmailModelMultipleMeetings($selection, $model_i18n,$site=null)
    {
        if (!mfModule::isModuleInstalled('emailer_spooler',$site))
                throw new mfException(__("Emailer spooler module is not present."));
        if ($model_i18n->isNotLoaded())
            throw new mfException(__("Model is invalid."));
        $email_company=SiteCompanyUtils::getSiteCompany($site)->get('email');
        $collection_email_sent=new CustomerEmailSentCollection(null,$site);          
        $collection_email_spooler=new EmailerSpoolerCollection(null);
        $action=mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
        $errors=array();
        foreach (self::loadMeetingAndCustomerFromSelection($selection,$site) as $meeting)
          {    
                if  (!$meeting->getCustomer()->hasEmail()) 
                {
                   $errors[]=__("Customer %s has not email.",(string)$meeting->getCustomer());
                    continue;
                }    
                try
                {                  
                  $message=$action->getComponent('/customers_meetings/email', array('COMMENT'=>false,'meeting'=>$meeting,'model_i18n'=>$model_i18n))->getContent();         
                }
                catch (SmartyCompilerException $e)
                {
                    trigger_error($e->getMessage());
                    throw new mfException(__("Error Syntax in model."));              
                }                                        
               // Email Sent 
               $sms=new CustomerEmailSent(null,$site);
               $sms->add(array('email'=>$meeting->getCustomer()->get('email'),
                               'model_id'=>$model_i18n->get('model_id'),
                               'body'=>$message,
                               'subject'=>$model_i18n->get('subject'),
                               'customer_id'=>$meeting->get('customer_id')));
               $collection_email_sent[]=$sms;


               $email=new EmailerSpooler();
               $email->add(array('to'=>$meeting->getCustomer()->get('email'),
                               'model_id'=>$model_i18n->get('model_id'),
                               'site_id'=> $model_i18n->getSite(),
                               'from'=>$email_company,
                               'body'=>$message,
                               'subject'=>$model_i18n->get('subject'),
                               'customer_id'=>$meeting->get('customer_id')));
               $collection_email_spooler[]=$email;
          }
          $collection_email_sent->save();
          $collection_email_spooler->save();
          // SMS History
          $collection_email_history=new CustomerEmailHistoryCollection(null,$site);  
          foreach ( $collection_email_sent as $email)
          {
               $history=new CustomerEmailHistory(null,$site); 
               $history->setUser($action->getUser()->getGuardUser());
               $history->setEmail($email);
               $collection_email_history[]=$history;
          }    
          $collection_email_history->save();
          return $errors;
    }
    
    
    static function sendEmailSalesModelMultipleMeetings($meetings,UserModelEmailI18n $model_i18n,$mode='sale1')
    {              
        $site=$meetings->getSite();
        if (!mfModule::isModuleInstalled('emailer_spooler',$site))
                throw new mfException(__("Emailer spooler module is not present."));
        if ($model_i18n->isNotLoaded())
            throw new mfException(__("Model is invalid."));
        $email_company=SiteCompanyUtils::getSiteCompany($site)->get('email');
        $collection_email_sent=new UserEmailSentCollection(null,$site);          
        $collection_email_spooler=new EmailerSpoolerCollection();
        $action=mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();  
        $errors=array();               
        foreach ($meetings as $meeting)
          {                   
                $sale=$mode=='sale1'?$meeting->getSale():$meeting->getSale2();
                if (!$sale->hasEmail())
                {
                    $errors[]=__("User %s has not email.",(string)$sale->getFormatter()->getUser()->upper());
                    continue;
                }                                                                    
                try
                {                  
                  $message=$action->getComponent('/customers_meetings/emailForSale', array('COMMENT'=>false,
                                'meeting'=>$meeting,
                                'user'=>$sale,
                                'model_i18n'=>$model_i18n))->getContent();         
                }
                catch (SmartyCompilerException $e)
                {
                    trigger_error($e->getMessage());
                    throw new mfException(__("Error Syntax in model."));              
                }                     
                
               // Email Sent 
               $sms=new UserEmailSent(null,$site);
               $sms->add(array('email'=>$sale->get('email'),
                               'model_id'=>$model_i18n->get('model_id'),
                               'body'=>$message,
                               'subject'=>$model_i18n->get('subject'),
                               'user_id'=>$sale));
               $collection_email_sent[]=$sms;


               $email=new EmailerSpooler();
               $email->add(array('to'=>$sale->get('email'),
                               'model_id'=>$model_i18n->get('model_id'),
                               'site_id'=> $model_i18n->getSite(),
                               'from'=>$email_company,
                               'body'=>$message,
                               'subject'=>$model_i18n->get('subject'),
                               'customer_id'=>$meeting->get('customer_id')));
               $collection_email_spooler[]=$email;
          }
          $collection_email_sent->save();
          $collection_email_spooler->save();
          // SMS History
          $collection_email_history=new UserEmailHistoryCollection(null,$site);  
          foreach ( $collection_email_sent as $email)
          {
               $history=new UserEmailHistory(null,$site); 
               $history->setUser($action->getUser()->getGuardUser());
               $history->setEmail($email);
               $collection_email_history[]=$history;
          }    
          $collection_email_history->save(); 
          return $errors;
    }
    
    static function sendEmailSale1ModelMultipleMeetings($selection,UserModelEmailI18n $model_i18n,$site=null)
    {
        return self::sendEmailSalesModelMultipleMeetings(self::loadMeetingAndSale1FromSelection($selection,$site), $model_i18n,'sale1');
    }
    
    static function sendEmailSale2ModelMultipleMeetings($selection,UserModelEmailI18n $model_i18n,$site=null)
    {
       return self::sendEmailSalesModelMultipleMeetings(self::loadMeetingAndSale2FromSelection($selection,$site), $model_i18n,'sale2'); 
    }
    
    
    static function loadMeetingAndSale1FromSelection($selection,$site=null)
    {
        $collection=new CustomerMeetingCollection(null,$site);
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('CustomerMeeting','User'))
                ->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().  
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('sales_id').
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."')".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   trigger_error($db->getQuery());
        if (!$db->getNumRows())
            return $collection;
        while ($items=$db->fetchObjects())
        {
            $item=$items->getCustomerMeeting();
            $item->set('sales_id',$items->getUser());
            $collection[$item->get('id')]=$item;
        }        
        return $collection;
    }        
    
    static function loadMeetingAndSale2FromSelection($selection,$site=null)
    {
        $collection=new CustomerMeetingCollection(null,$site);
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('CustomerMeeting','User'))
                ->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().  
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('sale2_id').
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."')".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
     //   trigger_error($db->getQuery());
        if (!$db->getNumRows())
            return $collection;
        while ($items=$db->fetchObjects())
        {
            $item=$items->getCustomerMeeting();
            $item->set('sale2_id',$items->getUser());
            $collection[$item->get('id')]=$item;
        }        
        return $collection;
    }       
    
    
    static function getPollutersForSelect(ConditionsQuery $where,$user,$site=null)
    {       
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".PartnerPolluterCompany::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('polluter_id').                                                        
                           " WHERE ".PartnerPolluterCompany::getTableField('id')." IS NOT NULL ".
                                    ($user->hasCredential(array(array('meeting_filter_equal_polluter_active')))?" AND ".PartnerPolluterCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".PartnerPolluterCompany::getTableField('id').
                           " ORDER BY ".PartnerPolluterCompany::getTableField('name')." ASC ".                          
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();        
        $items=array();
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {                              
            $items[$item->get('id')]=strtoupper($item->get('name'));
        }      
        return $items;
    }  
    
    static function getPollutersWithUsernameForSelect(ConditionsQuery $where,$user,$site=null)
    {       
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".PartnerPolluterCompany::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('polluter_id').                                                        
                           " WHERE ".PartnerPolluterCompany::getTableField('id')." IS NOT NULL ".
                                    ($user->hasCredential(array(array('meeting_filter_equal_polluter_active')))?" AND ".PartnerPolluterCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".PartnerPolluterCompany::getTableField('id').
                           " ORDER BY ".PartnerPolluterCompany::getTableField('name')." ASC ".                          
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();        
        $items=array();
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {                              
            $items[$item->get('id')]=$item->getNameWithUserName();
        }      
        return $items;
    }  
    
    static function getPolluters(ConditionsQuery $where,$user,$site=null)
    {       
        $cache= new mfCacheFile('polluters.meeting.conditions.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$user->hasCredential(array(array('meeting_filter_in_polluter_active')))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".PartnerPolluterCompany::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('polluter_id').($user->hasCredential(array(array('meeting_filter_in_polluter_active')))?" AND ".PartnerPolluterCompany::getTableField('is_active')."='YES' ":"").                            
                           " WHERE ".PartnerPolluterCompany::getTableField('id')." IS NOT NULL ".
                                    //($user->hasCredential(array(array('meeting_filter_in_polluter_active')))?" AND ".PartnerPolluterCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".PartnerPolluterCompany::getTableField('id').
                           " ORDER BY ".PartnerPolluterCompany::getTableField('is_active').", ".PartnerPolluterCompany::getTableField('name')." ASC ".                                         
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
    
    // UPDATE t_customers_meeting INNER JOIN t_customers_address ON t_customers_address.customer_id=t_customers_meeting.customer_id SET coordinates='' WHERE t_customers_meeting.id IN('8871','8879','8884')
    static function generateCoordinates($selection,$site=null)
    {      
         $messages=new mfArray();
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())               
                ->setQuery("SELECT ".CustomerAddress::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().                             
                           " INNER JOIN ".CustomerAddress::getTable()." ON ".CustomerAddress::getTableField('customer_id')."=".CustomerMeeting::getTableField('customer_id').
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."') AND ".                           
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
        SystemDebug::getInstance()->trace(date("Y-m-d H:i:s").":Meetingt:Multiple [".(string)mfCOntext::getInstance()->getUser()->getGuardUser()."] ".$addresses->getNumberOfValidAddress());
        return $messages;
    }
    
    static function generateCoordinatesFromFilter(CustomerMeetingsFormFilter $filter,$site=null)
    {      
      //  var_dump($filter->getQuery());
       $messages=new mfArray();      
       $query = str_replace("WHERE"," WHERE ".CustomerAddress::getTableField('coordinates')."='' AND ",$filter->getQuery());
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())               
                ->setObjects(array('CustomerAddress')) 
                ->setQuery($query)               
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
         SystemDebug::getInstance()->trace(date("Y-m-d H:i:s").":Meetingt:Generate FormFilter [".(string)mfCOntext::getInstance()->getUser()->getGuardUser()."] ".$addresses->getNumberOfValidAddress());
        return $messages;
    }
    
    static function getTeamsForSelect(ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('users.team.meeting.select2.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id')),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());   
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('telepro_id').
                           " INNER JOIN ".UserTeamUsers::getInnerForJoin('user_id').    
                           " INNER JOIN ".UserTeamUsers::getOuterForJoin('team_id').   
                           $where->getWhere().
                           " GROUP BY ".UserTeam::getTableField('id').
                           " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC ".
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
           $teams[$team->get('id')]=strtoupper($team->get('name'));
        }             
        $cache->register(serialize($teams));
        return $teams;
    } 
    
    
    static function getOpcRanges($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('range.opc.meeting.conditions.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractRangeI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('opc_range_id').
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
    
     static function getOpcRangeForSelect($lang,ConditionsQuery $where,$site=null)
    {     
        $cache= new mfCacheFile('range.opc.meeting.select.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());   
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerContractRangeI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('opc_range_id').
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
       
    
    static function updateMultipleMeetingFromMultipleContracts(CustomerContractMultipleProcess $multiple)
    {
        $is_hold=null;
        if (in_array('unhold',$multiple->getActions()))
        {                       
           $is_hold='NO';
           $hold='YES';
        } 
         if (in_array('hold',$multiple->getActions()))
        {                        
            $is_hold='YES';   
            $hold='NO';
        } 
        if ($is_hold)
        {    
             $db=mfSiteDatabase::getInstance()
                ->setParameters(array('is_hold'=>$is_hold,'hold'=>$hold))
                ->setQuery("UPDATE ".CustomerMeeting::getTable().
                           " INNER JOIN ".CustomerContract::getInnerForJoin('meeting_id').
                           " SET ".CustomerMeeting::getTableField('is_hold')."='{is_hold}'".
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$multiple->getSelection()->implode("','")."')".
                                " AND ".CustomerMeeting::getTableField('is_hold')."='{hold}'".
                           ";")
                ->makeSiteSqlQuery($multiple->getSite());  
            //echo $db->getQuery();
        }         
    }
    
   static  function setOpcAtEqualInAt($selection,$site=null)
    {         
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())               
                ->setQuery("UPDATE ".CustomerMeeting::getTable().                                                     
                           " SET opc_at=in_at".
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."') ". 
                           " AND ".CustomerMeeting::getTableField('is_hold')."='NO'".
                           ";")               
                ->makeSiteSqlQuery($site); 
    }        
    
    static function setOpcAtTimeToRange($selection,$site=null)
    {     
       foreach (CustomerContractRange::getRanges() as $range)
       {
           $db=mfSiteDatabase::getInstance()
                ->setParameters(array('from'=>$range->get('from'),'to'=>$range->get('to'),'range_id'=>$range->get('id')))               
                ->setQuery("UPDATE ".CustomerMeeting::getTable().                                                     
                           " SET opc_range_id='{range_id}'".
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."') ".                                                           
                                " AND TIME(opc_at) >= '{from}' AND TIME(opc_at) < '{to}' ".
                                " AND ".CustomerMeeting::getTableField('is_hold')."='NO'".
                           ";")               
                ->makeSiteSqlQuery($site);  
         //  echo $db->getQuery()."<br>";
       }    
    }
    
    static function updateSale2ForContracts(mfArray $selection,$parameters=array(),$site=null)
    {
      
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('sale_2_id'=>$parameters['contract_sale2_id']))
                ->setQuery("UPDATE ".CustomerContract::getTable(). 
                           " INNER JOIN ".CustomerContract::getOuterForJoin('meeting_id').
                           " SET ".CustomerContract::getTableField('sale_2_id')."='{sale_2_id}'". 
                           " WHERE ".CustomerContract::getTableField('meeting_id')." IN('".$selection->implode("','")."')". 
                                " AND ".CustomerMeeting::getTableField('is_hold')."='NO'".
                           ";")               
                ->makeSiteSqlQuery($site); 
       //echo $db->getQuery();
    }
    
     static function setInAtTimeToRange($selection,$site=null)
    {              
       foreach (CustomerContractRange::getRanges() as $range)
       {
           $db=mfSiteDatabase::getInstance()
                ->setParameters(array('from'=>$range->get('from'),'to'=>$range->get('to'),'range_id'=>$range->get('id')))               
                ->setQuery("UPDATE ".CustomerMeeting::getTable().                                                     
                           " SET opc_range_id='{range_id}'".
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."') ".                                                           
                                " AND TIME(in_at) >= '{from}' AND TIME(in_at) < '{to}' ".
                                " AND ".CustomerMeeting::getTableField('is_hold')."='NO'".
                           ";")               
                ->makeSiteSqlQuery($site);  
           //echo $db->getQuery()."<br>";
       }    
    }
    
    static function getLayersForSelect(ConditionsQuery $where,$user,$site=null)
    {       
        $cache= new mfCacheFile('layers.meeting.select.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$user->hasCredential(array(array('meeting_filter_equal_layer_active')))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".PartnerLayerCompany::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('partner_layer_id').                                                      
                           " WHERE ".PartnerLayerCompany::getTableField('id')." IS NOT NULL ".
                                    ($user->hasCredential(array(array('meeting_filter_equal_layer_active')))?" AND ".PartnerLayerCompany::getTableField('is_active')."='YES' ":"").
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
        $cache= new mfCacheFile('layers.meeting.conditions.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$user->hasCredential(array(array('meeting_filter_in_layer_active')))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".PartnerLayerCompany::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('partner_layer_id').($user->hasCredential(array(array('meeting_filter_in_layer_active')))?" AND ".PartnerLayerCompany::getTableField('is_active')."='YES' ":"").                            
                            " WHERE ".PartnerLayerCompany::getTableField('id')." IS NOT NULL ".
                                    //($user->hasCredential(array(array('meeting_filter_in_layer_active')))?" AND ".PartnerLayerCompany::getTableField('is_active')."='YES' ":"").
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
    
    
    static function sendEmailToSale1(CustomerMeeting $meeting)
    {
        if (!mfModule::isModuleInstalled('emailer_spooler',$meeting->getSite()))
            return mfMessages::getInstance()->addWarning(__("Emailer spooler module is not present."));
        $settings=new CustomerMeetingSettings(null,$meeting->getSite());
        if (!$settings->hasChangeStateSalesModelEmail())        
            return mfMessages::getInstance()->addWarning(__('Model for sale email is invalid.'));
        if (!$meeting->getSale()->hasEmail())               
            return mfMessages::getInstance()->addWarning(__("Sale %s has not email.",(string)$meeting->getSale()->getFormatter()->getUser()->upper()));
                  
        $action=mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
        $model_i18n=$settings->getChangeStateSalesModelEmail()->getI18n();
        $email_company=SiteCompanyUtils::getSiteCompany($meeting->getSite())->get('email');
        try
        {                  
          $message=$action->getComponent('/customers_meetings/emailChangesForSale', array('COMMENT'=>false,
                        'meeting'=>$meeting,
                        'user'=>$meeting->getSale(),
                        'model_i18n'=>$model_i18n))->getContent(); 
          //var_dump($message);
               $sms=new UserEmailSent(null,$meeting->getSite());
               $sms->add(array('email'=>$meeting->getSale()->get('email'),
                               'model_id'=>$model_i18n->get('model_id'),
                               'body'=>$message,
                               'subject'=>$model_i18n->get('subject'),
                               'user_id'=>$meeting->getSale()));
               $sms->save();
               // Spooler
               $email=new EmailerSpooler();
               $email->add(array('to'=>$meeting->getSale()->get('email'),
                               'model_id'=>$model_i18n->get('model_id'),
                               'site_id'=> $model_i18n->getSite(),
                               'from'=>$email_company,
                               'body'=>$message,
                               'subject'=>$model_i18n->get('subject'),
                               'customer_id'=>$meeting->get('customer_id')));
               $email->save();
               // History
               $history=new UserEmailHistory(null,$meeting->getSite()); 
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
    
    static function sendEmailToSale2(CustomerMeeting $meeting)
    {
        
    }
    
    static function removeMeetings(mfArray $selection,$site=null)
    {
        $messages=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".CustomerMeeting::getTable().                           
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."')".
                                 " AND ".CustomerMeeting::getTableField('status')."='DELETE'".
                           ";")
                ->makeSiteSqlQuery($site);  
        if (!$db->getNumRows())
            return $messages;        
        $meetings=new CustomerMeetingCollection(null,$site);
        while ($item=$db->fetchObject('CustomerMeeting'))
        {                           
            $meetings[$item->get('id')]= $item->loaded();      
        }                   
        $meetings->loaded();
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($meetings, 'meetings.remove')); 
        $meetings->delete();
        $messages[]=__("%s meeting(s) have(s) been removed.",$meetings->count());
        return $messages;
    }
    
    
    static function removeMeetingsBySelection(mfArray $selection,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("DELETE FROM ".CustomerContract::getTable().                           
                           " WHERE ".CustomerContract::getTableField('meeting_id')." IN('".$selection->implode("','")."')".                                 
                           ";")
                ->makeSiteSqlQuery($site);  
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("DELETE FROM ".CustomerMeetingForms::getTable().                           
                           " WHERE ".CustomerMeetingForms::getTableField('meeting_id')." IN('".$selection->implode("','")."')".                                 
                           ";")
                ->makeSiteSqlQuery($site);  
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("DELETE FROM ".CustomerMeeting::getTable().                           
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."')".                                 
                           ";")
                ->makeSiteSqlQuery($site);  
        return  $db->getAffectedRows();
    }        
    
     static function getCompaniesForSelect(ConditionsQuery $where,$user,$site=null)
    { 
        $cache= new mfCacheFile('companies.meeting.select.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$user->hasCredential(array(array('meeting_filter_equal_company_active')))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());   
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".CustomerMeetingCompany::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('company_id').                            
                           " WHERE ".CustomerMeetingCompany::getTableField('id')." IS NOT NULL ".
                                    ($user->hasCredential(array(array('meeting_filter_equal_company_active')))?" AND ".CustomerMeetingCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".CustomerMeetingCompany::getTableField('id').
                           " ORDER BY ".CustomerMeetingCompany::getTableField('name')." ASC ".                          
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
         {
             $cache->register(serialize(array()));
            return array();
        }       
        $items=array();
        while ($item=$db->fetchObject('CustomerMeetingCompany'))
        {                              
            $items[$item->get('id')]=strtoupper($item->get('name'));
        }      
        $cache->register(serialize($items));
        return $items;
    }  
    
    static function getCompanies(ConditionsQuery $where,$user,$site=null)
    {          
        $cache= new mfCacheFile('companies.meeting.conditions.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$user->hasCredential(array(array('meeting_filter_in_company_active')))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".CustomerMeetingCompany::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('company_id').($user->hasCredential(array(array('meeting_filter_in_company_active')))?" AND ".CustomerMeetingCompany::getTableField('is_active')."='YES' ":"").                            
                           " WHERE ".CustomerMeetingCompany::getTableField('id')." IS NOT NULL ".
                                    //($user->hasCredential(array(array('meeting_filter_in_company_active')))?" AND ".CustomerMeetingCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".CustomerMeetingCompany::getTableField('id').
                           " ORDER BY ".CustomerMeetingCompany::getTableField('name')." ASC ".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize(array()));
            return array();
        }         
        $item=new CustomerMeetingCompany(null,$site);
        $item->id=0;
        $items=array($item);
        while ($item=$db->fetchObject('CustomerMeetingCompany'))
        {                                              
             $items[$item->get('id')]=$item->loaded();          
        }
        $cache->register(serialize($items));
        return $items;
    } 
    
    static function getTeleproUsersForSelect2(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.telepro.meeting.select2.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').($user->hasCredential(array(array('meeting_filter_equal_telepro_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id').
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " LEFT JOIN ".UserFunctionI18n::getInnerForJoin('function_id').
                            ($user->hasCredential(array(array('meeting_filter_equal_telepro_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
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
    
    static function getSalesUsersForSelect2(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.sales1.meeting.'.md5($where->getWhere().($user->hasCredential(array(array('meeting_filter_equal_sale1_active'))))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sales_id').
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " LEFT JOIN ".UserFunctionI18n::getInnerForJoin('function_id'). 
                            ($user->hasCredential(array(array('meeting_filter_equal_sale1_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
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
    
    static function getSalesUsers2ForSelect2(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.sale2.meeting.select2.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$user->hasCredential(array(array('meeting_filter_equal_sale2_active')))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());   
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sale2_id').
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " LEFT JOIN ".UserFunctionI18n::getInnerForJoin('function_id'). 
                             ($user->hasCredential(array(array('meeting_filter_equal_sale2_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
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
    
    static function getAssistantUsersForSelect2(ConditionsQuery $where,$user,$site=null)
    {
        $cache= new mfCacheFile('users.assistant.meeting.select2.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$user->hasCredential(array(array('meeting_filter_equal_assistant_active')))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('assistant_id').                                                
                           ($user->hasCredential(array(array('meeting_filter_equal_assistant_active')))?" WHERE ".User::getTableField('is_active')."='YES' ".$where->getWhere("AND"):$where->getWhere()).
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
        $cache= new mfCacheFile('polluters.meeting.select2.'.md5($where->getWhere().mfContext::getInstance()->getUser()->getGuardUser()->get('id').$user->hasCredential(array(array('meeting_filter_equal_polluter_active')))),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance();
                $db->setParameters($where->getParameters())               
                ->setQuery("SELECT ".PartnerPolluterCompany::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('polluter_id').                                                        
                           " WHERE ".PartnerPolluterCompany::getTableField('id')." IS NOT NULL ".
                                    ($user->hasCredential(array(array('meeting_filter_equal_polluter_active')))?" AND ".PartnerPolluterCompany::getTableField('is_active')."='YES' ":"").
                                    $where->getWhere("AND").
                           " GROUP BY ".PartnerPolluterCompany::getTableField('id').
                           " ORDER BY ".PartnerPolluterCompany::getTableField('is_active').",".PartnerPolluterCompany::getTableField('name')." ASC ".                          
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
    
    
    static function createDefaultProductForContracts(Product $product)
    {      
       $site=$product->getSite();    
       $products_by_default=ProductSettings::load($site)->getDefaultProductsById();
       if (!in_array($product->get('id'),$products_by_default))
               return ;
       
        // Manage contracts without products
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('product_id'=>$product->get('id')))                
                ->setQuery("SELECT ".CustomerMeeting::getTableField('id')." FROM ".CustomerMeeting::getTable(). 
                           " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('meeting_id')." AND ".CustomerMeetingProduct::getTableField('product_id')."='{product_id}'".  
                           " WHERE  ".CustomerMeetingProduct::getTableField('id')." IS NULL".
                                    " AND is_hold='NO'".
                           " LIMIT 0,500".
                           ";")               
                ->makeSiteSqlQuery($site);  
        if (!$db->getNumRows())
           return ;
       //      echo $db->getQuery();
        $collection=new CustomerMeetingProductCollection(null,$site);
        while ($row=$db->fetchArray())
        {                                                              
                $item=new CustomerMeetingProduct(null,$site);
                $item->add(array('product_id'=>$product,'meeting_id'=>$row['id']));
                $collection[]=$item;         
        } 
        $collection->save();               
    }      
    
    
    static function getUsers($site=null)
    {                    
        $users=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('telepro_id').                        
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
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('sales_id').  
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
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " INNER JOIN ".CustomerMeeting::getOuterForJoin('sale2_id').  
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
    
    // ----------------- filling ------------------ //
    
    static function getUsersByFieldFromPager($field,$pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('User'))
                ->setQuery("SELECT {fields},". CustomerMeeting::getTableField('id')." as meeting_id FROM ".User::getTable().
                           " LEFT JOIN ".CustomerMeeting::getInnerForJoin($field).                         
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('meeting_id')]))
               continue;           
           $pager[$items->get('meeting_id')]->set($field,$items->hasUser()?$items->getUser():false);
        }        
    }
    
    static function getStatesFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>$pager->getUser()->getLanguage()))
                ->setObjects(array('CustomerMeetingStatus','CustomerMeetingStatusI18n'))
                ->setQuery("SELECT {fields},".CustomerMeeting::getTableField('id')." as meeting_id FROM ".CustomerMeetingStatus::getTable().
                           " LEFT JOIN ".CustomerMeeting::getInnerForJoin('state_id').
                           " LEFT JOIN ".CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'"     .
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('meeting_id')]))
               continue;           
           if ($items->hasCustomerMeetingStatus())
                $pager[$items->get('meeting_id')]->set('state_id',$items->getCustomerMeetingStatus()->setI18n($items->hasCustomerMeetingStatusI18n()?$items->getCustomerMeetingStatusI18n():false));
           else
               $pager[$items->get('meeting_id')]->set('state_id',false);
        }        
    }
    
    
    static function getCampaignsFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('CustomerMeetingCampaign'))
                ->setQuery("SELECT {fields},". CustomerMeeting::getTableField('id')." as meeting_id FROM ".CustomerMeetingCampaign::getTable().
                           " LEFT JOIN ".CustomerMeeting::getInnerForJoin('campaign_id').                         
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('meeting_id')]))
               continue;           
           $pager[$items->get('meeting_id')]->set('campaign_id',$items->hasCustomerMeetingCampaign()?$items->getCustomerMeetingCampaign():false);
        }        
    }
    
    static function getCallcentersFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('Callcenter'))
                ->setQuery("SELECT {fields},". CustomerMeeting::getTableField('id')." as meeting_id FROM ".Callcenter::getTable().
                           " LEFT JOIN ".CustomerMeeting::getInnerForJoin('callcenter_id').                         
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('meeting_id')]))
               continue;           
           $pager[$items->get('meeting_id')]->set('callcenter_id',$items->hasCallcenter()?$items->getCallcenter():false);
        }        
    }
    
    static function getProductsFromPager($pager)
    {       
       if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('CustomerMeeting','Product'))
                ->setQuery("SELECT {fields} FROM ".Product::getTable().
                           " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('product_id').     
                           " LEFT JOIN ".CustomerMeetingProduct::getOuterForJoin('meeting_id').     
                           " WHERE ".CustomerMeeting::getTableField('id')." IN(".implode(",",array_keys($pager->getItems())).")".
                           " AND ".CustomerMeetingProduct::getTableField('status')."='ACTIVE'".
                           " GROUP BY ".CustomerMeeting::getTableField('id').",".Product::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return array();        
        while ($items=$db->fetchObjects())
        {                   
            $key=$items->getCustomerMeeting()->get('id');       
            if (!isset($pager->items[$key]->products))
                $pager->items[$key]->products=array();
            $pager->items[$key]->products[]=$items->getProduct();
        }        
    } 
    
    
    static function getStatusCallFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('lang'=>$pager->getUser()->getLanguage()))
                ->setObjects(array('CustomerMeetingStatusCall','CustomerMeetingStatusCallI18n'))
                ->setQuery("SELECT {fields},".CustomerMeeting::getTableField('id')." as meeting_id FROM ".CustomerMeetingStatusCall::getTable().
                           " LEFT JOIN ".CustomerMeeting::getInnerForJoin('status_call_id').
                           " LEFT JOIN ".CustomerMeetingStatusCallI18n::getInnerForJoin('status_id')." AND lang='{lang}'"     .
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('meeting_id')]))
               continue;           
           if ($items->hasCustomerMeetingStatusCall())
                $pager[$items->get('meeting_id')]->set('status_call_id',$items->getCustomerMeetingStatusCall()->setI18n($items->hasCustomerMeetingStatusCallI18n()?$items->getCustomerMeetingStatusCallI18n():false));
           else
               $pager[$items->get('meeting_id')]->set('status_call_id',false);
        }        
    }
    
    static function getStatusLeadFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('lang'=>$pager->getUser()->getLanguage()))
                ->setObjects(array('CustomerMeetingStatusLead','CustomerMeetingStatusLeadI18n'))
                ->setQuery("SELECT {fields},".CustomerMeeting::getTableField('id')." as meeting_id FROM ".CustomerMeetingStatusLead::getTable().
                           " LEFT JOIN ".CustomerMeeting::getInnerForJoin('status_lead_id').
                           " LEFT JOIN ".CustomerMeetingStatusLeadI18n::getInnerForJoin('status_id')." AND lang='{lang}'"     .
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('meeting_id')]))
               continue;           
           if ($items->hasCustomerMeetingStatusLead())
                $pager[$items->get('meeting_id')]->set('status_lead_id',$items->getCustomerMeetingStatusLead()->setI18n($items->hasCustomerMeetingStatusLeadI18n()?$items->getCustomerMeetingStatusLeadI18n():false));
           else
               $pager[$items->get('meeting_id')]->set('status_lead_id',false);
        }        
    }
    
    
    static function getTypeFromPager($pager)
    {
        if (!$pager->hasItems())
            return null;
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('lang'=>$pager->getUser()->getLanguage()))
                ->setObjects(array('CustomerMeetingType','CustomerMeetingTypeI18n'))
                ->setQuery("SELECT {fields},".CustomerMeeting::getTableField('id')." as meeting_id FROM ".CustomerMeetingType::getTable().
                           " LEFT JOIN ".CustomerMeeting::getInnerForJoin('type_id').
                           " LEFT JOIN ".CustomerMeetingTypeI18n::getInnerForJoin('type_id')." AND lang='{lang}'"     .
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$pager->getKeys()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return ;  
        while ($items=$db->fetchObjects())
        {                   
           if (!isset($pager[$items->get('meeting_id')]))
               continue;           
           if ($items->hasCustomerMeetingType())
                $pager[$items->get('meeting_id')]->set('type_id',$items->getCustomerMeetingType()->setI18n($items->hasCustomerMeetingTypeI18n()?$items->getCustomerMeetingTypeI18n():false));
           else
               $pager[$items->get('meeting_id')]->set('type_id',false);
        }        
    }
}

