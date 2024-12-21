<?php

class CustomerMeetingExportKMLFilterBase extends CustomerMeetingExportKMLCollection {
    
    protected $filter=null,$user=null,$number_of_items=0,$site=null;
    
    function __construct($filter,$user,$site=null) 
    {
       $this->filter=$filter;    
       $this->site=$site;        
       $this->user=$user;       
       $this->filename=self::getDirectory($this->site)."/".$this->getName();
       $this->execute();
    }        
    
    function getUser()
    {
        return $this->user;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getFilter()
    {
        return $this->filter;
    }
    
    protected function getItemsFromDatabase($db)
    {      
        $this->collection=array();
        if (!$db->getNumRows())
            return ;       
        while ($items=$db->fetchObjects())
        {           
           $items->getCustomer()->set('address',$items->getCustomerAddress());
           $items->getCustomerMeeting()->set('customer_id',$items->getCustomer());           
           $dept=  substr($items->getCustomer()->getAddress()->get('postcode'),0,2);
           $date=$items->getCustomerMeeting()->getDate();        
           $this->collection[$dept][$date][]=$items->getCustomerMeeting();
        }      
        ksort($this->collection);   
    }
          
    function execute()
    {               
      //   var_dump($this->getFilter()->getWhere());
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setObjects(array('Customer','CustomerMeeting','CustomerAddress'))
                ->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id').
                           " WHERE ".CustomerAddress::getTableField('coordinates')."!='' ".  
                           " AND ".CustomerMeeting::getTableField('status')."='ACTIVE'".
                           $this->getFilter()->getWhere('AND').
                           " ORDER BY in_at ASC".
                           ";")
              ->makeSiteSqlQuery($this->site);   
        $this->number_of_items=$db->getNumRows();    
        $this->getItemsFromDatabase($db);    
    }
    
      function getNumberOfItems()
    {
        return $this->number_of_items;
    }
}