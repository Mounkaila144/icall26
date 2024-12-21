<?php


class UserProfilePager extends Pager {
    
   function __construct() {        
        parent::__construct(array("UserProfile","UserProfileI18n"));         
    }
    
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getUserProfile();                
              $item->setI18n($items->hasUserProfileI18n()?$items->getUserProfileI18n():false);            
              $this->items[$item->get('id')]=$item;                            
       }          
    }
}