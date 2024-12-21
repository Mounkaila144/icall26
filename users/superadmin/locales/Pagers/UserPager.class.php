<?php

class UserPager extends Pager {
    
    function __construct() {        
        parent::__construct(array("User","unlockedby"=>"User"));
        $this->setAlias(array('unlockedby'=>'unlockedby'));
    }
    
    protected function fetchObjects($db)
    {              
        while ($items = $db->fetchObjects()) 
        {                       
            $item=$items->getUser();   
            $item->set('unlocked_by',$items->hasUnlockedby()?$items->getUnlockedby():false);
            $this->items[$item->get('id')]=$item;                            
        }    
        
        // group
        UserGroupUtils::getUserGroupsFromPager($this);
        // functions
        UserFunctionUtils::getUserFunctionsFromPager($this);
        // teams
        UserTeamUtils::getTeamsForPager($this);
    }
}