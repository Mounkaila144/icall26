<?php


class DomoprimePreMeetingModelPager extends Pager{
    
        
    function __construct()
    {             
       parent::__construct(array('DomoprimePreMeetingModelI18n','DomoprimePreMeetingModel'));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getDomoprimePreMeetingModel();                  
              $item->setI18n($items->hasDomoprimePreMeetingModelI18n()?$items->getDomoprimePreMeetingModelI18n():0);          
              $this->items[$item->get('id')]=$item;                            
       }   
       DomoprimePreMeetingModelUtils::getPollutersFromPager($this);
    }
   
}
