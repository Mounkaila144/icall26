<?php


class PagerTeam extends Pager {
    
    function __construct() {        
        parent::__construct(array("UserTeam",'manager1'=>'User','manager2'=>'User'));        
        $this->setAlias(array("manager1"=>"manager1","manager2"=>"manager2"));        
    }
    
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getUserTeam();                     
              $items->getUserTeam()->set('manager_id',($items->hasManager1()?$items->getManager1():0));                                            
              $items->getUserTeam()->set('manager2_id',($items->hasManager2()?$items->getManager2():0));                               
              $this->items[$item->get('id')]=$item;                            
       }         
    }
}