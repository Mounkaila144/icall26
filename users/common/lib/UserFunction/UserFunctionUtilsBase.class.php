<?php


class UserFunctionBaseUtils {
    
    static function getFieldValuesForI18nSelect($name,$lang=null,$site=null)
    {
        $values=array();      
        if ($lang==null)
            $lang=mfContext::getInstance ()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang,"name"=>$name))
                ->setQuery("SELECT DISTINCT({name}),".UserFunctionI18n::getKeyName()." FROM ".UserFunctionI18n::getTable()." WHERE lang='{lang}' ORDER BY {name} ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
            $values[$value[UserFunctionI18n::getKeyName()]]=$value[$name];
        }      
        return $values;
    }
    
    static function getUsersByFunctionForSelectForUser($function,$user,$site=null)
    {
        $conditions=new ConditionsQuery();           
         if (($user->hasGroups('telepro_manager') || $user->hasCredential(array(array('meeting_select_telepro_manager_as_user')))) && $function=='TELEPRO') 
         {                
                $conditions->setWhere(User::getTableField('id').
                                    " IN('".$user->getGuardUser()->getTeamUsers()->getKeys()->implode("','")."')"                                      
                                          );   
         }         
         elseif ($user->hasGroups('sales_manager') || $user->hasCredential(array(array('meeting_select_sales_manager_as_user'))))
         {                
                $conditions->setWhere(User::getTableField('id').
                                    " IN('".$user->getGuardUser()->getTeamUsers()->getKeys()->implode("','")."')"                                      
                                          );   
         }     
         elseif ($user->hasCredential(array(array('meeting_select_collaborators_as_user'))))
         {                    
                $conditions->setWhere(User::getTableField('id').
                                    " IN('".$user->getGuardUser()->getCollaboraters()->getKeys()->implode("','")."')"                                      
                                          );   
         }         
        $values=array(); 
        // Sale & telepro manager itself        
        if (($user->hasGroups('sales_manager') || $user->hasCredential(array(array('meeting_select_sales_manager_in')))) && $function=='SALES')
        {            
           $values[$user->getGuardUser()->get('id')]=$user->getGuardUser();
        }
        elseif (($user->hasGroups('telepro_manager') || $user->hasCredential(array(array('meeting_select_telepro_manager_in')))) && $function=='TELEPRO')
        {            
           $values[$user->getGuardUser()->get('id')]=$user->getGuardUser();
        }          
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("function"=>$function,'user_id'=>$user->getGuardUser()->get('id')))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').                       
                           " WHERE ".UserFunction::getTableField('name')."='{function}' ".   
                                    $conditions->getWhere('AND').
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY ".User::getTableField('status').", UPPER(".User::getTableField('lastname').") COLLATE utf8_general_ci ASC ".                                                  
                           ";")               
                ->makeSiteSqlQuery($site); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('User'))
        {            
            $values[$item->get('id')]=mb_strtoupper($item->get('lastname')." ".$item->get('firstname')).($item->get('status')=='DELETE'?__(" (Delete)"):"");
        }                
        return $values;   
    }
    
    
    
    
     static function getUsersByFunctionForSelect($function,$site=null)
    {
        $values=array();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("function"=>$function))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE ".UserFunction::getTableField('name')."='{function}' ".
                           " ORDER BY UPPER(".User::getTableField('firstname').") COLLATE utf8_general_ci ASC ".     
                           ";")
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('User'))
        {            
            $values[$item->get('id')]=mb_strtoupper($item->get('lastname')." ".$item->get('firstname'));
        }      
        return $values;
    }
    
     static function getUsersByFunctionsForSelect($functions,$site=null)
    {
        $values=array();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE ".UserFunction::getTableField('name')." IN('".implode("','",(array)$functions)."') ".
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY UPPER(".User::getTableField('firstname').") COLLATE utf8_general_ci ASC ".                       
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('User'))
        {            
            $values[$item->get('id')]= mb_strtoupper($item->get('lastname')." ".$item->get('firstname'));
        }      
        return $values;
    }
    
    
      function isFunctionsExists($name,$functions,$site=null)
    {
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT ".$name." FROM ".UserFunction::getTable().                      
                       " WHERE ".UserFunction::getTableField($name)." IN('".implode("','",$functions)."')".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $functions;
        $unknown=$functions;    
        while ($row=$db->fetchArray())
        {          
            if (($key=array_search($row[$name],$functions))!==false)
            {
                unset($unknown[$key]);
            }                   
        }  
        return $unknown;   
    }
    
    function setFunctionsForUserImport(User $user,$functions)
    {
        if ($user->isNotLoaded())
           return ;        
        // Find unknown categories
        $unKnown=self::isFunctionsExists('name',$functions,$user->getSite());       
        // take only existing ProductCategoryI18N not yet linked with group
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('user_id'=>$user->get('id')))
            ->setQuery("SELECT ".UserFunction::getFieldsAndKeyWithTable()." FROM ".UserFunction::getTable().
                       " LEFT JOIN ".UserFunctions::getInnerForJoin('function_id').
                            " AND ".UserFunctions::getTableField('user_id')."={user_id}".
                       " WHERE ".UserFunctions::getTableField('id')." IS NULL".                    
                       " AND ".UserFunction::getTableField('name')." IN('".implode("','",$functions)."')".
                       ";")               
            ->makeSiteSqlQuery($user->getSite());  
        if (!$db->getNumRows())
            return $unKnown;;
        $collection=new UserFunctionsCollection(null,$user->getSite());
        while ($item=$db->fetchObject('UserFunction'))
        {               
            $join=new UserFunctions(null,$user->getSite());
            $join->add(array('user_id'=>$user,'function_id'=>$item));
            $collection[]=$join;
        }
        $collection->save();           
        return $unKnown;
    }
    
    
     static function getUsersByFunctionsByTeamForUserForSelect(User $user,$functions,$site=null)
    {
        $users=$user->getUsersOfMyTeams(); 
        $values=new mfArray();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE ".UserFunction::getTableField('name')." IN('".implode("','",(array)$functions)."') ".
                                  " AND ".User::getTableField('id')." IN('".$users->getKeys()->implode("','")."')".
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY UPPER(".User::getTableField('firstname').") COLLATE utf8_general_ci ASC ".                       
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('User'))
        {            
            $values[$item->get('id')]= mb_strtoupper($item->get('lastname')." ".$item->get('firstname'));
        }      
        return $values;
    }
    
     static function getUsersByFunctionsForAdminForSelect($functions,$site=null)
    {
        $values=new mfArray();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE ".UserFunction::getTableField('name')." IN('".implode("','",(array)$functions)."') ".
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY UPPER(".User::getTableField('firstname').") COLLATE utf8_general_ci ASC ".                       
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('User'))
        {            
            $values[$item->get('id')]= mb_strtoupper($item->get('lastname')." ".$item->get('firstname'));
        }      
        return $values;
    }
    
    
     function getActiveFunctionsForSelect($site=null)
    {
        $values=new mfArray();      
        if ($lang==null)
            $lang=mfContext::getInstance ()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT * FROM ".UserFunctionI18n::getTable()." WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('UserFunctionI18n'))
        { 
            $values[$item->get('function_id')]=mb_strtoupper($item->get('value'));
        }      
        return $values;
    }
    
    
     
    static function getUsersByFunctionsForAdminForSelect2($functions,$site=null)
    {
        $values=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE ".UserFunction::getTableField('name')." IN('".implode("','",(array)$functions)."') ".
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY ".User::getTableField('is_active').", UPPER(".User::getTableField('firstname').") COLLATE utf8_general_ci ASC ".                       
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('User'))
        {            
            $values[$item->get('id')]= $item;
        }  
        return $values;
    }
    
    static function getUsersByFunctionsByTeamForUserForSelect2(User $user,$functions,$site=null)
    {
        $users=$user->getUsersOfMyTeams(); 
        $values=new mfArray();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE ".UserFunction::getTableField('name')." IN('".implode("','",(array)$functions)."') ".
                                  " AND ".User::getTableField('id')." IN('".$users->getKeys()->implode("','")."')".
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY ".User::getTableField('is_active').", UPPER(".User::getTableField('firstname').") COLLATE utf8_general_ci ASC ".                       
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('User'))
        {            
            $values[$item->get('id')]= $item;
        } 
        return $values;
    }
    
    
    static function getUsersByFunctionForSelect2ForUser($function,$user,$site=null)
    {
        $conditions=new ConditionsQuery();           
         if (($user->hasGroups('telepro_manager') || $user->hasCredential(array(array('meeting_select_telepro_manager_as_user')))) && $function=='TELEPRO') 
         {                
                $conditions->setWhere(User::getTableField('id').
                                    " IN('".$user->getGuardUser()->getTeamUsers()->getKeys()->implode("','")."')"                                      
                                          );   
         }         
         elseif ($user->hasGroups('sales_manager') || $user->hasCredential(array(array('meeting_select_sales_manager_as_user'))))
         {                
                $conditions->setWhere(User::getTableField('id').
                                    " IN('".$user->getGuardUser()->getTeamUsers()->getKeys()->implode("','")."')"                                      
                                          );   
         }     
         elseif ($user->hasCredential(array(array('meeting_select_collaborators_as_user'))))
         {                    
                $conditions->setWhere(User::getTableField('id').
                                    " IN('".$user->getGuardUser()->getCollaboraters()->getKeys()->implode("','")."')"                                      
                                          );   
         }         
        $values=array(); 
        // Sale & telepro manager itself        
        if (($user->hasGroups('sales_manager') || $user->hasCredential(array(array('meeting_select_sales_manager_in')))) && $function=='SALES')
        {            
           $values[$user->getGuardUser()->get('id')]=$user->getGuardUser();
        }
        elseif (($user->hasGroups('telepro_manager') || $user->hasCredential(array(array('meeting_select_telepro_manager_in')))) && $function=='TELEPRO')
        {            
           $values[$user->getGuardUser()->get('id')]=$user->getGuardUser();
        }          
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("function"=>$function,'user_id'=>$user->getGuardUser()->get('id')))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').                       
                           " WHERE ".UserFunction::getTableField('name')."='{function}' ".   
                                    $conditions->getWhere('AND').
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY ".User::getTableField('is_active').", UPPER(".User::getTableField('lastname').") COLLATE utf8_general_ci ASC ".                                                  
                           ";")               
                ->makeSiteSqlQuery($site); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('User'))
        {            
            $values[$item->get('id')]=$item;
        }                
        return $values;   
    }
       
    
    static function getUserFunctionsFromPager($pager)
    {
          if (!$pager->hasItems())
            return ;
    
        $db=mfSiteDatabase::getInstance();
         $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getLanguage()))  
                  ->setQuery("SELECT user_id, GROUP_CONCAT(".UserFunctionI18n::getTableField('value')." ORDER BY ".UserFunctionI18n::getTableField('value')." ASC) as functions".
                            " FROM ".UserFunctions::getTable().
                            
                            " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                            " LEFT JOIN ".UserFunctionI18n::getTable()." ON ".UserFunctions::getTableField('function_id')."=".UserFunctionI18n::getTableField('function_id').
                            " AND ".UserFunctionI18n::getTableField('lang')."='{lang}'".
                            " WHERE ".UserFunctions::getTableField('user_id')." IN('".mfArray::create($pager->getKeys())->implode("','")."')".                                             
                            " GROUP BY user_id")          
                ->makeSiteSqlQuery($pager->getSite());
      // echo $db->getQuery();
        if (!$db->getNumRows()) 
            return;             
        while($row= $db->fetchArray()) 
        {
           
          $pager[$row['user_id']]->functions=$row['functions']; 
        }
    } 
}
