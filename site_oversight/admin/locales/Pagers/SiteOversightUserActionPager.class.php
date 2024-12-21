<?php


class SiteOversightUserActionPager extends Pager {
    
    
    function __construct()
    {             
        parent::__construct(array('SiteOversightUserAction','creator'=>'User','user'=>'User'));
        $this->setAlias(array( 
                             'creator'=>'creator',
                             'user'=>'user'));
    } 
    
    protected function fetchObjects($db)
    {              
        
        while ($items = $db->fetchObjects()) 
        {                 
            $item=$items->getSiteOversightUserAction();    
            $item->set('user_id',$items->hasUser()?$items->getUser():false);
            $item->set('creator_id',$items->hasCreator()?$items->getCreator():false);
            $this->items[$item->get('id')]=$item;                            
        }         
        
    }
    
   
              
}

