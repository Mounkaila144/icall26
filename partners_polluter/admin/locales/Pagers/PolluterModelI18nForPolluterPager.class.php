<?php


class PolluterModelI18nForPolluterPager extends Pager{
    
        
    function __construct()
    {             
       parent::__construct(array('PartnerPolluterModelI18n','PartnerPolluterModel'));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
             // echo$items->get('document')."<br/>";
              $item=$items->getPartnerPolluterModel();                  
              $item->setI18n($items->hasPartnerPolluterModelI18n()?$items->getPartnerPolluterModelI18n():0);    
              $item->set('document',$items->get('document'));
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
}
