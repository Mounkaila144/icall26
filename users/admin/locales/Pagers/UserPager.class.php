<?php


class UserPager extends Pager {
    
   function __construct() {        
        parent::__construct(array("User","CallCenter","unlockedby"=>"User",'creator'=>'User','CustomerContractCompany'));
          $this->setAlias(array('unlockedby'=>'unlockedby','creator'=>'creator',
                             ));
    }
    
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                                        
              $item=$items->getUser();   
              $item->set('has_user_permissions',(boolean)$items->get('has_user_permissions'));
              $item->set('userPermissions',$items->get('user_permissions'));
              $item->set('callcenter_id',$items->hasCallCenter()?$items->getCallCenter():0);
              $item->set('company_id',$items->hasCustomerContractCompany()?$items->getCustomerContractCompany():false);
              $item->set('unlocked_by',$items->hasUnlockedby()?$items->getUnlockedby():false);
              $item->set('creator_id',$items->hasCreator()?$items->getCreator():false);
              $this->items[$item->get('id')]=$item;                            
       }    
     //   echo mfSiteDatabase::getInstance()->getQuery();
      // UserUtils::getConnectedUsersFromPager($this); // A revoir trop lent
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'users.list.pager')); 
        UserTeamUtils::getManagersAndTeamsFromPager($this);  
    }
}